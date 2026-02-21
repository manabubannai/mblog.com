<?php
$page_title = 'Dark Mode Test — mblog.com';
$page_description = 'ダークモードのテストページ。実装確認用。';
$extra_css = ['/dark-mode.css'];
require dirname(__DIR__) . '/header.php';
?>

<button id="dark-toggle" onclick="toggleDark()">🌙 ダーク</button>

<p class="brand"><a href="https://mblog.com/">manablog</a></p>
<time>21 Feb, 2026</time>
<h1 class="title">ダークモード — テストページ</h1>

<p>これはダークモードの表示確認用ページです。右上のボタンでライト/ダークを切り替えられます。ページをリロードしてもモードが維持されます（localStorage使用）。</p>

<h2>テキストと見出し</h2>

<p>本文テキスト。<a href="#">リンクの色</a>もダークモード対応。通常のテキストは読みやすいグレーに。背景は #141414。</p>

<h3>小見出し（h3）</h3>

<p>段落テキスト。バイオハッキング・健康最適化・AIの実験記録。毎日のHealth Logで積み上げている。</p>

<hr>

<h2>リスト</h2>

<ul>
  <li>Oura Ring — 睡眠・HRV・Readinessスコア</li>
  <li>Withings Body Scan — 体重・体脂肪・筋肉量</li>
  <li>3 Seeds Protein + EVOO + ライスベリーライス</li>
  <li>Cannabis × 瞑想 → HRV計測実験（進行中）</li>
</ul>

<h2>コードブロック / Health Log形式</h2>

<pre>■ Morning Self-Check
- Body: 8/10
- Mind: 9/10
- Spirit: 8/10

■ Sleep (Oura Ring)
- Total Sleep: 7時間17分
- Avg HRV: 35ms
- Readiness: 76

■ Food
- Breakfast: オムレツ（卵3個）+ ライスベリーライス
  ~694kcal / P:32g / F:28g / C:77g
  *Feedback from AI: [Recovery Plate] ...</pre>

<h2>引用ブロック</h2>

<blockquote>
  <p>HRVはストレスの量を測るのではなく、身体がストレスにどう反応するかを測る。</p>
</blockquote>

<p>以上がダークモードのテスト。右上ボタンで切り替えてください。</p>

<hr>
<p style="font-size:14px; opacity:0.5;">※ このページは確認後に削除します。</p>

<script>
function toggleDark() {
  const html = document.documentElement;
  const btn = document.getElementById('dark-toggle');
  if (html.getAttribute('data-theme') === 'dark') {
    html.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
    btn.textContent = '🌙 ダーク';
  } else {
    html.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    btn.textContent = '☀️ ライト';
  }
}

// Restore preference on load
(function() {
  const saved = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const html = document.documentElement;
  const btn = document.getElementById('dark-toggle');
  if (saved === 'dark' || (!saved && prefersDark)) {
    html.setAttribute('data-theme', 'dark');
    if (btn) btn.textContent = '☀️ ライト';
  } else {
    html.setAttribute('data-theme', 'light');
  }
})();
</script>

<?php require dirname(__DIR__) . '/footer.php'; ?>
