<?php
header('Content-Type: application/json; charset=utf-8');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Load API key
$configPath = dirname(__DIR__, 2) . '/config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Server configuration missing']);
    exit;
}
require $configPath;

if (!defined('ANTHROPIC_API_KEY') || ANTHROPIC_API_KEY === 'your-api-key-here') {
    http_response_code(500);
    echo json_encode(['error' => 'API key not configured']);
    exit;
}

// Rate limiting
$ip = $_SERVER['REMOTE_ADDR'];
$now = time();

// Global daily limit: 200 requests per day for all users combined
$globalLimitFile = '/tmp/ai_feedback_global.json';
$dailyMaxRequests = 200;
$todayStart = strtotime('today');

$globalRequests = [];
if (file_exists($globalLimitFile)) {
    $data = json_decode(file_get_contents($globalLimitFile), true);
    if (is_array($data)) {
        $globalRequests = array_filter($data, function ($ts) use ($todayStart) {
            return $ts >= $todayStart;
        });
        $globalRequests = array_values($globalRequests);
    }
}

if (count($globalRequests) >= $dailyMaxRequests) {
    http_response_code(429);
    echo json_encode(['error' => '本日のリクエスト上限に達しました。明日またお試しください。']);
    exit;
}

// Per-IP limit: 10 requests per hour
$rateLimitFile = '/tmp/ai_feedback_rate_' . md5($ip) . '.json';
$windowSeconds = 3600;
$maxRequests = 10;

$requests = [];
if (file_exists($rateLimitFile)) {
    $data = json_decode(file_get_contents($rateLimitFile), true);
    if (is_array($data)) {
        $requests = array_filter($data, function ($ts) use ($now, $windowSeconds) {
            return $ts > ($now - $windowSeconds);
        });
        $requests = array_values($requests);
    }
}

if (count($requests) >= $maxRequests) {
    http_response_code(429);
    echo json_encode(['error' => 'レート制限に達しました。1時間に10回までリクエストできます。']);
    exit;
}

// Get and validate input
$input = json_decode(file_get_contents('php://input'), true);
$mealText = isset($input['meal_text']) ? trim($input['meal_text']) : '';

if ($mealText === '') {
    http_response_code(400);
    echo json_encode(['error' => '食事内容を入力してください。']);
    exit;
}

if (mb_strlen($mealText) > 2000) {
    http_response_code(400);
    echo json_encode(['error' => '入力は2000文字以内にしてください。']);
    exit;
}

// System prompt (same as the one displayed on the page)
$systemPrompt = <<<'PROMPT'
あなたは栄養管理AIアシスタントです。

■ 役割
ユーザーの食事を記録し、栄養科学に基づいたフィードバックを返します。

■ 食事ログのルール
- ユーザーが食事のテキストを送ったら、以下のフォーマットで記録する
- カロリー・PFC（タンパク質/脂質/炭水化物）を推定する

■ フォーマット
Breakfast/Lunch/Dinner : メニュー [合計: ~〇〇kcal, P: 〇g, F: 〇g, C: 〇g]
*フィードバック: フィードバック本文

■ フィードバックのスタイル
- PFC（カロリー計算）だけでなく、栄養科学の視点で書く
- 微量栄養素（ビタミン、ミネラル）の吸収効率に言及
- 食材の組み合わせによる相乗効果を指摘
- 腸内環境、抗酸化、抗炎症の観点を含める
- 改善提案は具体的に（「野菜を増やせ」ではなく「パプリカを追加するとビタミンCが卵の鉄分吸収を2-3倍に高める」）
- タグは付けない

■ トーン
- 簡潔。短文。
- 褒めるべきは褒める、改善点は正直に言う
- 専門用語を使いつつ、分かりやすく
- 日本語で返す
PROMPT;

// Call Claude API
$requestBody = json_encode([
    'model' => 'claude-sonnet-4-5-20250929',
    'max_tokens' => 1024,
    'system' => $systemPrompt,
    'messages' => [
        ['role' => 'user', 'content' => $mealText]
    ]
]);

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $requestBody,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'x-api-key: ' . ANTHROPIC_API_KEY,
        'anthropic-version: 2023-06-01'
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    http_response_code(502);
    echo json_encode(['error' => 'APIへの接続に失敗しました。']);
    exit;
}

if ($httpCode !== 200) {
    http_response_code(502);
    echo json_encode(['error' => 'APIからエラーが返されました（HTTP ' . $httpCode . '）']);
    exit;
}

$result = json_decode($response, true);
$text = '';
if (isset($result['content']) && is_array($result['content'])) {
    foreach ($result['content'] as $block) {
        if (isset($block['type']) && $block['type'] === 'text') {
            $text .= $block['text'];
        }
    }
}

if ($text === '') {
    http_response_code(502);
    echo json_encode(['error' => 'APIから有効なレスポンスがありませんでした。']);
    exit;
}

// Record this request for rate limiting
$requests[] = $now;
file_put_contents($rateLimitFile, json_encode($requests));

$globalRequests[] = $now;
file_put_contents($globalLimitFile, json_encode($globalRequests));

echo json_encode(['feedback' => $text]);
