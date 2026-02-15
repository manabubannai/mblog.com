<?php require dirname(__DIR__) . '/header.php'; ?>

<style>
  .village-container { max-width: 720px; margin: 0 auto; padding: 20px; }
  .village-title { font-size: 28px; font-weight: bold; margin-bottom: 8px; }
  .village-subtitle { color: #666; margin-bottom: 32px; font-size: 15px; }
  
  /* Submit Form */
  .submit-form { background: #f8f8f8; border-radius: 12px; padding: 24px; margin-bottom: 40px; }
  .submit-form h3 { margin-top: 0; font-size: 18px; }
  .submit-form input[type="text"],
  .submit-form textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; margin-bottom: 12px; box-sizing: border-box; font-family: inherit; }
  .submit-form textarea { height: 120px; resize: vertical; }
  .submit-form input[type="file"] { margin-bottom: 12px; }
  .submit-btn { background: #111; color: #fff; border: none; padding: 12px 28px; border-radius: 8px; font-size: 15px; cursor: pointer; }
  .submit-btn:hover { background: #333; }
  
  /* Log Entries */
  .log-entry { border-bottom: 1px solid #eee; padding: 24px 0; }
  .log-entry:last-child { border-bottom: none; }
  .log-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
  .log-name { font-weight: bold; font-size: 16px; }
  .log-date { color: #999; font-size: 13px; }
  .log-photo { max-width: 100%; border-radius: 8px; margin-bottom: 12px; }
  .log-text { white-space: pre-wrap; font-size: 15px; line-height: 1.7; }
  .no-logs { color: #999; text-align: center; padding: 60px 0; }
  
  /* Manabu badge */
  .badge-pacemaker { background: #f0c040; color: #333; font-size: 11px; padding: 2px 8px; border-radius: 4px; margin-left: 8px; font-weight: normal; }
</style>

<div class="village-container">
  <div class="village-title">🏋️ Health Log Village</div>
  <div class="village-subtitle">健康ログを淡々と積み上げる場所。1日1投稿、写真+ログだけ。</div>

<?php
// --- Config ---
$dataDir = dirname(__DIR__) . '/village-data';
$uploadDir = $dataDir . '/photos';
if (!is_dir($dataDir)) mkdir($dataDir, 0755, true);
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
$dbFile = $dataDir . '/logs.sqlite';

// --- DB Setup ---
$db = new SQLite3($dbFile);
$db->exec('CREATE TABLE IF NOT EXISTS logs (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  log_text TEXT NOT NULL,
  photo TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  is_pacemaker INTEGER DEFAULT 0
)');

// --- Handle Submit ---
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name']) && !empty($_POST['log_text'])) {
  $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
  $logText = htmlspecialchars(trim($_POST['log_text']), ENT_QUOTES, 'UTF-8');
  $photoPath = null;
  
  // Simple spam check
  if (strlen($name) < 50 && strlen($logText) < 5000) {
    // Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
      if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) && $_FILES['photo']['size'] < 5 * 1024 * 1024) {
        $filename = uniqid('log_') . '.' . $ext;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . '/' . $filename)) {
          $photoPath = $filename;
        }
      }
    }
    
    $isPacemaker = (mb_strtolower($name) === 'manabu' || mb_strpos($name, 'マナブ') !== false) ? 1 : 0;
    
    $stmt = $db->prepare('INSERT INTO logs (name, log_text, photo, is_pacemaker) VALUES (:name, :log, :photo, :pm)');
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':log', $logText, SQLITE3_TEXT);
    $stmt->bindValue(':photo', $photoPath, SQLITE3_TEXT);
    $stmt->bindValue(':pm', $isPacemaker, SQLITE3_INTEGER);
    $stmt->execute();
    
    $msg = '✅ ログを投稿しました';
  }
}
?>

  <!-- Submit Form -->
  <div class="submit-form">
    <h3>📝 今日のログを投稿</h3>
    <?php if ($msg): ?><p style="color: green; margin-bottom: 12px;"><?= $msg ?></p><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="名前（ニックネームOK）" required maxlength="50">
      <textarea name="log_text" placeholder="今日の食事ログを貼り付け&#10;&#10;例:&#10;Breakfast: 目玉焼き3個、白米、味噌汁&#10;[Total: ~650kcal, P: 28g, F: 18g, C: 80g]&#10;*Feedback: [Choline Boost] 卵3個でコリン450mg確保..." required maxlength="5000"></textarea>
      <input type="file" name="photo" accept="image/jpeg,image/png,image/webp">
      <br>
      <button type="submit" class="submit-btn">投稿する</button>
    </form>
  </div>

  <!-- Log Entries -->
  <div>
<?php
$results = $db->query('SELECT * FROM logs ORDER BY is_pacemaker DESC, created_at DESC LIMIT 100');
$hasLogs = false;
while ($row = $results->fetchArray(SQLITE3_ASSOC)):
  $hasLogs = true;
?>
    <div class="log-entry">
      <div class="log-header">
        <div>
          <span class="log-name"><?= $row['name'] ?></span>
          <?php if ($row['is_pacemaker']): ?><span class="badge-pacemaker">🏃 Pacemaker</span><?php endif; ?>
        </div>
        <span class="log-date"><?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></span>
      </div>
      <?php if ($row['photo']): ?>
        <img class="log-photo" src="/village-data/photos/<?= $row['photo'] ?>" alt="food log" loading="lazy">
      <?php endif; ?>
      <div class="log-text"><?= nl2br($row['log_text']) ?></div>
    </div>
<?php endwhile; ?>
<?php if (!$hasLogs): ?>
    <div class="no-logs">まだログがありません。最初の1人になろう 💪</div>
<?php endif; ?>
  </div>
</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>
