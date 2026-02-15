<?php require dirname(__DIR__) . '/header.php'; ?>

<style>
  .meetup-container { max-width: 600px; margin: 0 auto; padding: 20px; }
  .meetup-title { font-size: 26px; font-weight: bold; margin-bottom: 8px; }
  .meetup-subtitle { color: #666; margin-bottom: 32px; font-size: 15px; line-height: 1.7; }
  .form-group { margin-bottom: 20px; }
  .form-group label { display: block; font-weight: bold; margin-bottom: 6px; font-size: 15px; }
  .form-group .note { color: #888; font-size: 13px; margin-bottom: 6px; }
  .form-group input[type="text"],
  .form-group input[type="email"],
  .form-group select,
  .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; box-sizing: border-box; font-family: inherit; }
  .form-group textarea { height: 100px; resize: vertical; }
  .radio-group label { font-weight: normal; display: block; padding: 6px 0; }
  .radio-group input { margin-right: 8px; }
  .submit-btn { background: #111; color: #fff; border: none; padding: 14px 32px; border-radius: 8px; font-size: 16px; cursor: pointer; }
  .submit-btn:hover { background: #333; }
  .success-msg { background: #f0faf0; border: 1px solid #c0e0c0; border-radius: 8px; padding: 24px; text-align: center; margin-top: 20px; }
</style>

<div class="meetup-container">
  <div class="meetup-title">🌴 チェンマイ ゆるい集まり</div>
  <div class="meetup-subtitle">
    健康、AI、働き方、人生。<br>
    ゆるく話せる場を作りたいと思っています。<br>
    参加を検討している方は、以下のフォームを送ってください。
  </div>

<?php
$dataDir = dirname(__DIR__) . '/meetup-data';
if (!is_dir($dataDir)) mkdir($dataDir, 0755, true);
$dbFile = $dataDir . '/responses.sqlite';
$db = new SQLite3($dbFile);
$db->exec('CREATE TABLE IF NOT EXISTS responses (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  email TEXT,
  location TEXT,
  can_visit_cm TEXT,
  preferred_day TEXT,
  intro TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

$submitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
  $stmt = $db->prepare('INSERT INTO responses (name, email, location, can_visit_cm, preferred_day, intro) VALUES (:name, :email, :loc, :visit, :day, :intro)');
  $stmt->bindValue(':name', trim($_POST['name']), SQLITE3_TEXT);
  $stmt->bindValue(':email', trim($_POST['email'] ?? ''), SQLITE3_TEXT);
  $stmt->bindValue(':loc', trim($_POST['location'] ?? ''), SQLITE3_TEXT);
  $stmt->bindValue(':visit', trim($_POST['can_visit_cm'] ?? ''), SQLITE3_TEXT);
  $stmt->bindValue(':day', trim($_POST['preferred_day'] ?? ''), SQLITE3_TEXT);
  $stmt->bindValue(':intro', trim($_POST['intro'] ?? ''), SQLITE3_TEXT);
  $stmt->execute();
  $submitted = true;
}

if ($submitted): ?>
  <div class="success-msg">
    <p style="font-size: 24px; margin-bottom: 8px;">✅</p>
    <p style="font-size: 17px; font-weight: bold;">送信しました！</p>
    <p style="color: #666;">詳細が決まり次第、ご連絡します。</p>
  </div>
<?php else: ?>
  <form method="POST">
    <div class="form-group">
      <label>名前（ニックネームOK）</label>
      <input type="text" name="name" required maxlength="50">
    </div>

    <div class="form-group">
      <label>メールアドレス</label>
      <div class="note">連絡用。任意です。</div>
      <input type="email" name="email" maxlength="100">
    </div>

    <div class="form-group">
      <label>今どこに住んでますか？</label>
      <input type="text" name="location" placeholder="例: 東京、バンコク、チェンマイ" maxlength="100">
    </div>

    <div class="form-group">
      <label>チェンマイに来れそうですか？</label>
      <div class="radio-group">
        <label><input type="radio" name="can_visit_cm" value="住んでる"> チェンマイに住んでる</label>
        <label><input type="radio" name="can_visit_cm" value="来れる"> タイミング合えば来れる</label>
        <label><input type="radio" name="can_visit_cm" value="オンライン希望"> オンラインなら参加したい</label>
        <label><input type="radio" name="can_visit_cm" value="未定"> まだわからない</label>
      </div>
    </div>

    <div class="form-group">
      <label>希望の曜日・時間帯</label>
      <div class="note">複数OKです</div>
      <input type="text" name="preferred_day" placeholder="例: 土曜の午後、平日夜" maxlength="200">
    </div>

    <div class="form-group">
      <label>ひとこと自己紹介</label>
      <div class="note">任意。何をしてる人か、何に興味があるか。</div>
      <textarea name="intro" maxlength="1000" placeholder="例: フリーランスエンジニア。健康管理とAIに興味あり。"></textarea>
    </div>

    <button type="submit" class="submit-btn">送信する</button>
  </form>
<?php endif; ?>
</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>
