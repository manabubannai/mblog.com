<?php
$page_title = '[Test] Body Comparison — Health Log';
$page_description = 'Test page: body comparison section for Health Log';
$extra_css = ['/health-log.css'];
require dirname(__DIR__) . '/header.php';
?>

<style>
.comparison-section {
  margin: 0 0 32px;
}

.comparison-section h2 {
  font-size: 13px;
  color: #999;
  font-weight: normal;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin: 0 0 14px;
  font-family: 'adelle', serif;
}

.comparison-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
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
  color: #bbb;
  font-size: 12px;
  font-family: 'adelle', serif;
}

.comparison-card .card-body {
  padding: 12px;
}

.comparison-card .label {
  font-size: 11px;
  color: #999;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 6px;
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
  font-size: 12.5px;
  line-height: 1.9;
  color: #555;
  font-family: 'adelle', serif;
}

.comparison-card .stats li {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid rgba(0,0,0,0.04);
  padding: 2px 0;
}

.comparison-card .stats li:last-child {
  border-bottom: none;
}

.comparison-card .stats .val {
  font-weight: 500;
  color: #333;
}

.card-now {
  border-color: rgba(0,0,0,0.1);
}

.card-goal {
  border-color: rgba(45, 74, 62, 0.25);
  background: rgba(45, 74, 62, 0.02);
}

.card-goal .date {
  color: #2d4a3e;
}

.card-goal .photo-slot {
  background: rgba(45, 74, 62, 0.07);
  color: #2d4a3e;
  opacity: 0.5;
}
</style>

<div style="max-width: 640px; margin: 0 auto; padding: 20px;">

  <p style="font-size: 13px; color: #aaa; margin-bottom: 24px; font-family: 'adelle', serif;">
    🧪 テストページ — Health Logのページ上部に置く「体の比較」セクションのデザイン案
  </p>

  <!-- パターン A: シンプル数値のみ -->
  <div class="comparison-section">
    <h2>パターン A — 数値のみ（写真なし）</h2>
    <div class="comparison-grid">
      <div class="comparison-card card-now">
        <div class="card-body">
          <div class="label">Now</div>
          <div class="date">Feb 2026</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">61.6 kg</span></li>
            <li><span>体脂肪率</span><span class="val">—%</span></li>
            <li><span>筋肉量</span><span class="val">— kg</span></li>
            <li><span>内臓脂肪</span><span class="val">—</span></li>
          </ul>
        </div>
      </div>
      <div class="comparison-card card-goal">
        <div class="card-body">
          <div class="label">Goal</div>
          <div class="date">Feb 2027</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">65 kg</span></li>
            <li><span>体脂肪率</span><span class="val">15%</span></li>
            <li><span>筋肉量</span><span class="val">↑ kg</span></li>
            <li><span>内臓脂肪</span><span class="val">↓</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <hr style="border: none; border-top: 1px solid rgba(0,0,0,0.06); margin: 32px 0;">

  <!-- パターン B: 写真スロット付き -->
  <div class="comparison-section">
    <h2>パターン B — 写真スロット付き</h2>
    <div class="comparison-grid">
      <div class="comparison-card card-now">
        <div class="photo-slot">📷 Feb 2026</div>
        <div class="card-body">
          <div class="label">Now</div>
          <div class="date">Feb 2026</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">61.6 kg</span></li>
            <li><span>体脂肪率</span><span class="val">—%</span></li>
            <li><span>筋肉量</span><span class="val">— kg</span></li>
          </ul>
        </div>
      </div>
      <div class="comparison-card card-goal">
        <div class="photo-slot">🎯 Feb 2027</div>
        <div class="card-body">
          <div class="label">Goal</div>
          <div class="date">Feb 2027</div>
          <ul class="stats">
            <li><span>体重</span><span class="val">65 kg</span></li>
            <li><span>体脂肪率</span><span class="val">15%</span></li>
            <li><span>筋肉量</span><span class="val">↑</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <hr style="border: none; border-top: 1px solid rgba(0,0,0,0.06); margin: 32px 0;">

  <!-- パターン C: ひとつの帯に横並び -->
  <div class="comparison-section">
    <h2>パターン C — シンプル帯スタイル</h2>
    <div style="background: #f8f8f8; border-radius: 10px; padding: 16px; display: flex; gap: 0;">
      <div style="flex: 1; padding-right: 16px; border-right: 1px solid rgba(0,0,0,0.08);">
        <div style="font-size: 11px; color: #aaa; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; font-family: 'adelle', serif;">Now — Feb 2026</div>
        <div style="font-size: 22px; font-weight: 700; color: #333; font-family: 'adelle', serif;">61.6 <span style="font-size: 13px; font-weight: 400; color: #888;">kg</span></div>
        <div style="font-size: 12px; color: #999; margin-top: 4px; font-family: 'adelle', serif;">バルクアップ開始</div>
      </div>
      <div style="flex: 1; padding-left: 16px;">
        <div style="font-size: 11px; color: #2d4a3e; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; font-family: 'adelle', serif;">Goal — Feb 2027</div>
        <div style="font-size: 22px; font-weight: 700; color: #2d4a3e; font-family: 'adelle', serif;">65 <span style="font-size: 13px; font-weight: 400; color: #888;">kg</span></div>
        <div style="font-size: 12px; color: #999; margin-top: 4px; font-family: 'adelle', serif;">筋肉量↑ 体脂肪↓</div>
      </div>
    </div>
  </div>

</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>
