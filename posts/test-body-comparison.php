<?php
$page_title = '[Test] Body Comparison — Health Log';
$page_description = 'Test page: body comparison section for Health Log';
$extra_css = ['/health-log.css'];
require dirname(__DIR__) . '/header.php';
?>

<style>
.comparison-section {
  margin: 0 0 40px;
}

.comparison-section h2 {
  font-size: 12px;
  color: #aaa;
  font-weight: normal;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin: 0 0 14px;
  font-family: 'adelle', serif;
}

.comparison-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}

.comparison-card {
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 10px;
  overflow: hidden;
  background: #fff;
}

.comparison-card .photo-slot {
  width: 100%;
  aspect-ratio: 3/4;
  background: #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ccc;
  font-size: 12px;
  font-family: 'adelle', serif;
}

.comparison-card .photo-slot img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top;
  display: block;
}

.comparison-card .card-body {
  padding: 12px;
}

.comparison-card .label {
  font-size: 10px;
  color: #aaa;
  text-transform: uppercase;
  letter-spacing: 0.07em;
  margin-bottom: 3px;
  font-family: 'adelle', serif;
}

.comparison-card .date {
  font-size: 13px;
  font-weight: 600;
  color: #333;
  margin-bottom: 10px;
  font-family: 'adelle', serif;
}

.comparison-card .stats {
  list-style: none;
  padding: 0;
  margin: 0;
  outline: none;
  background: none;
  font-size: 12px;
  line-height: 1;
  color: #666;
  font-family: 'adelle', serif;
}

.comparison-card .stats li {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid rgba(0,0,0,0.04);
  padding: 5px 0;
}

.comparison-card .stats li:last-child {
  border-bottom: none;
}

.comparison-card .stats .val {
  font-weight: 600;
  color: #333;
}

.card-goal {
  border-color: rgba(45, 74, 62, 0.2);
}

.card-goal .label {
  color: #2d4a3e;
}

.card-goal .date {
  color: #2d4a3e;
}
</style>

<div style="max-width: 640px; margin: 0 auto; padding: 20px;">

  <p style="font-size: 12px; color: #bbb; margin-bottom: 32px; font-family: 'adelle', serif;">
    🧪 テストページ — Health Log 体の比較セクション
  </p>

  <!-- パターン A: 写真スロット付き -->
  <div class="comparison-section">
    <h2>パターン A — 写真 + 数値</h2>
    <div class="comparison-grid">
      <div class="comparison-card">
        <div class="photo-slot"><img src="/img/body-now-2026.jpg" alt="Now Feb 2026"></div>
        <div class="card-body">
          <div class="label">Now</div>
          <div class="date">Feb 2026</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">61.6 kg</span></li>
            <li><span>目標</span><span class="val">バルクアップ</span></li>
          </ul>
        </div>
      </div>
      <div class="comparison-card card-goal">
        <div class="photo-slot">
          <img src="/img/body-goal-2027.jpg" alt="Goal body Feb 2027">
        </div>
        <div class="card-body">
          <div class="label">Goal</div>
          <div class="date">Feb 2027</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">65 kg</span></li>
            <li><span>体脂肪</span><span class="val">↓ 絞る</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <hr style="border: none; border-top: 1px solid rgba(0,0,0,0.06); margin: 32px 0;">

  <!-- パターン B: 写真大きめ・数値なし -->
  <div class="comparison-section">
    <h2>パターン B — 写真メイン・シンプル</h2>
    <div class="comparison-grid">
      <div class="comparison-card">
        <div class="photo-slot"><img src="/img/body-now-2026.jpg" alt="Now Feb 2026"></div>
        <div class="card-body">
          <div class="label">Now</div>
          <div class="date">Feb 2026<br><span style="font-size:11px;font-weight:400;color:#aaa;">61.6 kg</span></div>
        </div>
      </div>
      <div class="comparison-card card-goal">
        <div class="photo-slot">
          <img src="/img/body-goal-2027.jpg" alt="Goal body Feb 2027">
        </div>
        <div class="card-body">
          <div class="label">Goal</div>
          <div class="date">Feb 2027<br><span style="font-size:11px;font-weight:400;color:#aaa;">目標体型</span></div>
        </div>
      </div>
    </div>
  </div>

  <hr style="border: none; border-top: 1px solid rgba(0,0,0,0.06); margin: 32px 0;">

  <!-- パターン C: 写真のみ・ラベルオーバーレイ -->
  <div class="comparison-section">
    <h2>パターン C — 写真のみ・オーバーレイ</h2>
    <div class="comparison-grid">
      <div style="position:relative; border-radius:10px; overflow:hidden; aspect-ratio:3/4;">
        <img src="/img/body-now-2026.jpg" alt="Now Feb 2026" style="width:100%; height:100%; object-fit:cover; object-position:top; display:block;">
        <div style="position:absolute; bottom:0; left:0; right:0; background:rgba(0,0,0,0.45); color:#fff; padding:10px 12px;">
          <div style="font-size:10px; opacity:0.7; letter-spacing:0.05em;">NOW</div>
          <div style="font-size:14px; font-weight:600;">Feb 2026</div>
          <div style="font-size:12px; opacity:0.8;">61.6 kg</div>
        </div>
      </div>
      <div style="position:relative; border-radius:10px; overflow:hidden; aspect-ratio:3/4;">
        <img src="/img/body-goal-2027.jpg" alt="Goal" style="width:100%; height:100%; object-fit:cover; object-position:top; display:block;">
        <div style="position:absolute; bottom:0; left:0; right:0; background:rgba(45,74,62,0.7); color:#fff; padding:10px 12px;">
          <div style="font-size:10px; opacity:0.8; letter-spacing:0.05em;">GOAL</div>
          <div style="font-size:14px; font-weight:600;">Feb 2027</div>
          <div style="font-size:12px; opacity:0.8;">目標体型</div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>
