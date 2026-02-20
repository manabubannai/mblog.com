<?php
$page_title = "AI筋トレフォームチェッカー（ベータ）";
$meta_description = "AIがリアルタイムで筋トレのフォームをチェック。MediaPipe Poseで関節角度を解析し、スクワット・デッドリフト・プッシュアップのフォーム改善をサポート。";
$extra_css = "form-checker";
include '../header.php';
?>

<style>
.form-checker-wrap {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
  font-family: 'Noto Sans JP', sans-serif;
}

.badge-beta {
  display: inline-block;
  background: #2d4a3e;
  color: #fff;
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 4px;
  margin-left: 8px;
  vertical-align: middle;
  letter-spacing: 1px;
}

.exercise-selector {
  display: flex;
  gap: 10px;
  margin: 20px 0;
  flex-wrap: wrap;
}

.exercise-btn {
  padding: 10px 20px;
  border: 2px solid #2d4a3e;
  background: #fff;
  color: #2d4a3e;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 600;
  transition: all 0.2s;
}

.exercise-btn.active, .exercise-btn:hover {
  background: #2d4a3e;
  color: #fff;
}

.video-area {
  display: grid;
  grid-template-columns: 1fr 300px;
  gap: 20px;
  margin-top: 20px;
}

@media (max-width: 700px) {
  .video-area { grid-template-columns: 1fr; }
}

.canvas-wrap {
  position: relative;
  background: #111;
  border-radius: 12px;
  overflow: hidden;
  aspect-ratio: 4/3;
}

#input-video {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  transform: scaleX(-1);
}

#output-canvas {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  transform: scaleX(-1);
}

.feedback-panel {
  background: #f8f8f8;
  border-radius: 12px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.feedback-panel h3 {
  font-size: 14px;
  color: #666;
  margin: 0;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.score-circle {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: #e0e0e0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  font-weight: 700;
  margin: 0 auto;
  transition: all 0.5s;
}

.score-circle.good { background: #d4edda; color: #155724; }
.score-circle.ok   { background: #fff3cd; color: #856404; }
.score-circle.bad  { background: #f8d7da; color: #721c24; }

.feedback-items {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.feedback-item {
  background: #fff;
  border-radius: 8px;
  padding: 8px 12px;
  font-size: 13px;
  border-left: 3px solid #ccc;
  line-height: 1.4;
}

.feedback-item.good { border-color: #28a745; }
.feedback-item.warn { border-color: #ffc107; }
.feedback-item.bad  { border-color: #dc3545; }

.angle-display {
  font-size: 11px;
  color: #999;
  margin-top: 4px;
}

.controls {
  display: flex;
  gap: 10px;
  margin-top: 16px;
  flex-wrap: wrap;
}

.btn-start {
  padding: 12px 24px;
  background: #2d4a3e;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  flex: 1;
}

.btn-start:hover { background: #1e3329; }

.btn-upload {
  padding: 12px 24px;
  background: #fff;
  color: #2d4a3e;
  border: 2px solid #2d4a3e;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
}

.status-bar {
  background: #2d4a3e;
  color: #fff;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 13px;
  margin-top: 12px;
  text-align: center;
}

.loading {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 200px;
  color: #fff;
  font-size: 14px;
  flex-direction: column;
  gap: 12px;
}

.spinner {
  width: 32px;
  height: 32px;
  border: 3px solid rgba(255,255,255,0.3);
  border-top-color: #fff;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

.tips-section {
  margin-top: 32px;
  padding: 20px;
  background: #f0f4f2;
  border-radius: 12px;
}

.tips-section h3 {
  font-size: 16px;
  font-weight: 700;
  margin: 0 0 12px;
  color: #2d4a3e;
}

.tips-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 12px;
}

.tip-card {
  background: #fff;
  border-radius: 8px;
  padding: 12px;
  font-size: 13px;
  line-height: 1.5;
}

.tip-card strong {
  display: block;
  font-size: 14px;
  margin-bottom: 4px;
  color: #2d4a3e;
}
</style>

<div class="form-checker-wrap">
  <h1>AI筋トレフォームチェッカー <span class="badge-beta">BETA</span></h1>
  <p style="color:#666; font-size:14px;">カメラに向かってトレーニング。AIがリアルタイムでフォームを解析してフィードバックします。</p>

  <div class="exercise-selector">
    <button class="exercise-btn active" onclick="setExercise('squat', this)">🦵 スクワット</button>
    <button class="exercise-btn" onclick="setExercise('pushup', this)">💪 プッシュアップ</button>
    <button class="exercise-btn" onclick="setExercise('deadlift', this)">🏋️ デッドリフト</button>
    <button class="exercise-btn" onclick="setExercise('row', this)">🔙 ベントオーバーロウ</button>
  </div>

  <div class="controls">
    <button class="btn-start" id="startBtn" onclick="startCamera()">📷 カメラを起動</button>
    <label class="btn-upload">
      📁 動画をアップロード
      <input type="file" accept="video/*" style="display:none" onchange="loadVideo(event)">
    </label>
  </div>

  <div id="statusBar" class="status-bar" style="display:none"></div>

  <div class="video-area">
    <div class="canvas-wrap" id="canvasWrap">
      <div class="loading" id="loadingMsg">
        <div>カメラを起動してください</div>
      </div>
      <video id="input-video" playsinline autoplay muted style="display:none"></video>
      <canvas id="output-canvas"></canvas>
    </div>

    <div class="feedback-panel">
      <h3>フォームスコア</h3>
      <div class="score-circle" id="scoreCircle">--</div>

      <h3>フィードバック</h3>
      <div class="feedback-items" id="feedbackItems">
        <div class="feedback-item" style="color:#999">カメラを起動するとフィードバックが表示されます</div>
      </div>
    </div>
  </div>

  <div class="tips-section">
    <h3 id="tipsTitle">💡 スクワット — チェックポイント</h3>
    <div class="tips-grid" id="tipsGrid">
      <div class="tip-card"><strong>膝の向き</strong>つま先と膝が同じ方向を向いているか</div>
      <div class="tip-card"><strong>背中の角度</strong>背筋をまっすぐ保ち、前傾しすぎない</div>
      <div class="tip-card"><strong>膝の深さ</strong>太ももが床と平行になるまで下げる</div>
      <div class="tip-card"><strong>重心</strong>かかとに体重が乗っているか</div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose/pose.js" crossorigin="anonymous"></script>

<script>
let currentExercise = 'squat';
let pose = null;
let camera = null;
let isRunning = false;

const EXERCISES = {
  squat: {
    name: 'スクワット',
    tips: [
      { title: '膝の向き', desc: 'つま先と膝が同じ方向を向いているか' },
      { title: '背中の角度', desc: '背筋をまっすぐ保ち、前傾しすぎない' },
      { title: '膝の深さ', desc: '太ももが床と平行になるまで下げる' },
      { title: '重心', desc: 'かかとに体重が乗っているか' },
    ]
  },
  pushup: {
    name: 'プッシュアップ',
    tips: [
      { title: '体のライン', desc: '頭からかかとまで一直線を保つ' },
      { title: '肘の角度', desc: '肘は体に対して45度程度' },
      { title: '腰の位置', desc: '腰が落ちたり上がったりしない' },
      { title: '首の位置', desc: '首を中立に保ち、下を向かない' },
    ]
  },
  deadlift: {
    name: 'デッドリフト',
    tips: [
      { title: '背中のアーチ', desc: '腰椎の自然なアーチを維持する' },
      { title: 'バーの軌道', desc: 'バーを体に沿わせてまっすぐ引く' },
      { title: '膝とヒップ', desc: '同時に伸ばし、腰だけで引かない' },
      { title: '肩甲骨', desc: '肩をすくめず、後ろに引いて固定' },
    ]
  },
  row: {
    name: 'ベントオーバーロウ',
    tips: [
      { title: '背中の角度', desc: '上体を45〜60度前傾させる' },
      { title: '引く方向', desc: '肘を真後ろに引き、肩甲骨を寄せる' },
      { title: '腰の安定', desc: '腰が丸まらないよう固定する' },
      { title: '首', desc: '自然に伸ばし、顎を引く' },
    ]
  }
};

function setExercise(ex, btn) {
  currentExercise = ex;
  document.querySelectorAll('.exercise-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  updateTips();
}

function updateTips() {
  const ex = EXERCISES[currentExercise];
  document.getElementById('tipsTitle').textContent = `💡 ${ex.name} — チェックポイント`;
  document.getElementById('tipsGrid').innerHTML = ex.tips.map(t =>
    `<div class="tip-card"><strong>${t.title}</strong>${t.desc}</div>`
  ).join('');
}

function getAngle(a, b, c) {
  const radians = Math.atan2(c.y - b.y, c.x - b.x) - Math.atan2(a.y - b.y, a.x - b.x);
  let angle = Math.abs(radians * 180 / Math.PI);
  if (angle > 180) angle = 360 - angle;
  return Math.round(angle);
}

function analyzeSquat(lm) {
  const items = [];
  let score = 100;

  // 膝角度（左右平均）
  const kneeAngleL = getAngle(lm[23], lm[25], lm[27]); // hip-knee-ankle left
  const kneeAngleR = getAngle(lm[24], lm[26], lm[28]); // hip-knee-ankle right
  const kneeAngle = Math.round((kneeAngleL + kneeAngleR) / 2);

  if (kneeAngle < 90) {
    items.push({ cls: 'good', text: `膝の曲がり ◎ (${kneeAngle}°) フル可動域`, });
  } else if (kneeAngle < 130) {
    items.push({ cls: 'warn', text: `膝の曲がり △ (${kneeAngle}°) もう少し深く`, });
    score -= 15;
  } else {
    items.push({ cls: 'bad', text: `膝の曲がり ✕ (${kneeAngle}°) スクワットが浅すぎ`, });
    score -= 30;
  }

  // 背中の傾き（肩と腰のy差）
  const shoulderY = (lm[11].y + lm[12].y) / 2;
  const hipY = (lm[23].y + lm[24].y) / 2;
  const torsoAngle = Math.abs(shoulderY - hipY);

  if (torsoAngle > 0.25) {
    items.push({ cls: 'good', text: '上体の角度 ◎ 適切な前傾' });
  } else {
    items.push({ cls: 'warn', text: '上体 △ 少し前傾を意識して' });
    score -= 10;
  }

  // 膝の左右バランス
  const kneeDiff = Math.abs(kneeAngleL - kneeAngleR);
  if (kneeDiff < 10) {
    items.push({ cls: 'good', text: '左右バランス ◎' });
  } else {
    items.push({ cls: 'warn', text: `左右差あり △ (差: ${kneeDiff}°) 均等に体重を` });
    score -= 10;
  }

  return { items, score };
}

function analyzePushup(lm) {
  const items = [];
  let score = 100;

  // 体のライン（肩・腰・足首のy座標がほぼ同じか）
  const shoulderY = (lm[11].y + lm[12].y) / 2;
  const hipY = (lm[23].y + lm[24].y) / 2;
  const ankleY = (lm[27].y + lm[28].y) / 2;

  const lineDeviation = Math.abs(hipY - (shoulderY + ankleY) / 2);
  if (lineDeviation < 0.05) {
    items.push({ cls: 'good', text: '体のライン ◎ まっすぐ保てている' });
  } else if (hipY > shoulderY + 0.05) {
    items.push({ cls: 'bad', text: '腰が落ちています ✕ 腹筋に力を入れて' });
    score -= 25;
  } else {
    items.push({ cls: 'warn', text: '腰が上がり気味 △ 体を一直線に' });
    score -= 15;
  }

  // 肘角度
  const elbowAngleL = getAngle(lm[11], lm[13], lm[15]);
  const elbowAngleR = getAngle(lm[12], lm[14], lm[16]);
  const elbowAngle = Math.round((elbowAngleL + elbowAngleR) / 2);

  if (elbowAngle < 100) {
    items.push({ cls: 'good', text: `肘の角度 ◎ (${elbowAngle}°) 深い可動域` });
  } else if (elbowAngle < 140) {
    items.push({ cls: 'warn', text: `肘の角度 △ (${elbowAngle}°) もう少し下げて` });
    score -= 15;
  } else {
    items.push({ cls: 'bad', text: `肘が伸びすぎ ✕ (${elbowAngle}°)` });
    score -= 25;
  }

  return { items, score };
}

function analyzeDeadlift(lm) {
  const items = [];
  let score = 100;

  // 背中のアーチ（肩と腰の相対角度）
  const shoulderMid = { x: (lm[11].x + lm[12].x) / 2, y: (lm[11].y + lm[12].y) / 2 };
  const hipMid = { x: (lm[23].x + lm[24].x) / 2, y: (lm[23].y + lm[24].y) / 2 };
  const kneeAngle = getAngle(lm[23], lm[25], lm[27]);

  if (kneeAngle > 140) {
    items.push({ cls: 'good', text: `膝の角度 ◎ (${kneeAngle}°) ロックアウト良好` });
  } else if (kneeAngle > 110) {
    items.push({ cls: 'warn', text: `膝 △ (${kneeAngle}°) もう少し伸ばして` });
    score -= 15;
  } else {
    items.push({ cls: 'bad', text: `膝の伸びが不十分 ✕ (${kneeAngle}°)` });
    score -= 25;
  }

  // 上体の前傾
  const torsoLean = Math.abs(shoulderMid.x - hipMid.x);
  if (torsoLean < 0.1) {
    items.push({ cls: 'good', text: '上体 ◎ まっすぐ立てている' });
  } else {
    items.push({ cls: 'warn', text: '上体が前に傾いています △' });
    score -= 15;
  }

  return { items, score };
}

function analyzeRow(lm) {
  const items = [];
  let score = 100;

  // 肘の引き具合
  const elbowAngleL = getAngle(lm[11], lm[13], lm[15]);
  const elbowAngle = elbowAngleL;

  if (elbowAngle < 70) {
    items.push({ cls: 'good', text: `肘の引き ◎ (${elbowAngle}°) 十分引けている` });
  } else if (elbowAngle < 110) {
    items.push({ cls: 'warn', text: `肘の引き △ (${elbowAngle}°) もう少し後ろへ` });
    score -= 20;
  } else {
    items.push({ cls: 'bad', text: `引きが浅い ✕ (${elbowAngle}°) 肩甲骨を寄せて` });
    score -= 30;
  }

  // 上体の角度
  const shoulderY = (lm[11].y + lm[12].y) / 2;
  const hipY = (lm[23].y + lm[24].y) / 2;
  if (Math.abs(shoulderY - hipY) > 0.1) {
    items.push({ cls: 'good', text: '前傾姿勢 ◎ 適切な角度' });
  } else {
    items.push({ cls: 'warn', text: '前傾が浅い △ もう少し倒して' });
    score -= 15;
  }

  return { items, score };
}

function analyze(landmarks) {
  switch(currentExercise) {
    case 'squat':    return analyzeSquat(landmarks);
    case 'pushup':   return analyzePushup(landmarks);
    case 'deadlift': return analyzeDeadlift(landmarks);
    case 'row':      return analyzeRow(landmarks);
    default:         return analyzeSquat(landmarks);
  }
}

function updateUI(result) {
  const scoreEl = document.getElementById('scoreCircle');
  const feedbackEl = document.getElementById('feedbackItems');

  const s = Math.max(0, Math.min(100, result.score));
  scoreEl.textContent = s;
  scoreEl.className = 'score-circle ' + (s >= 80 ? 'good' : s >= 60 ? 'ok' : 'bad');

  feedbackEl.innerHTML = result.items.map(item =>
    `<div class="feedback-item ${item.cls}">${item.text}</div>`
  ).join('');
}

async function initPose() {
  pose = new Pose({
    locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/pose/${file}`
  });
  pose.setOptions({
    modelComplexity: 1,
    smoothLandmarks: true,
    enableSegmentation: false,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5
  });
  pose.onResults(onResults);
  await pose.initialize();
}

function onResults(results) {
  const canvas = document.getElementById('output-canvas');
  const ctx = canvas.getContext('2d');
  const video = document.getElementById('input-video');

  canvas.width = video.videoWidth || 640;
  canvas.height = video.videoHeight || 480;

  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.drawImage(results.image, 0, 0, canvas.width, canvas.height);

  if (results.poseLandmarks) {
    // スケルトン描画
    drawConnectors(ctx, results.poseLandmarks, POSE_CONNECTIONS, { color: '#00ff88', lineWidth: 3 });
    drawLandmarks(ctx, results.poseLandmarks, { color: '#fff', lineWidth: 1, radius: 5 });

    const result = analyze(results.poseLandmarks);
    updateUI(result);
  }
}

async function startCamera() {
  const btn = document.getElementById('startBtn');
  const video = document.getElementById('input-video');
  const loadingMsg = document.getElementById('loadingMsg');
  const statusBar = document.getElementById('statusBar');

  if (isRunning) {
    if (camera) camera.stop();
    isRunning = false;
    btn.textContent = '📷 カメラを起動';
    video.style.display = 'none';
    loadingMsg.style.display = 'flex';
    loadingMsg.innerHTML = '<div>カメラを起動してください</div>';
    statusBar.style.display = 'none';
    return;
  }

  loadingMsg.innerHTML = '<div class="spinner"></div><div>AIモデルを読み込み中...</div>';
  loadingMsg.style.display = 'flex';
  statusBar.style.display = 'block';
  statusBar.textContent = 'MediaPipe Poseを初期化中...';

  try {
    await initPose();
    const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
    video.srcObject = stream;
    video.style.display = 'block';
    loadingMsg.style.display = 'none';

    camera = new Camera(video, {
      onFrame: async () => { await pose.send({ image: video }); },
      width: 640, height: 480
    });
    camera.start();

    isRunning = true;
    btn.textContent = '⏹ 停止';
    statusBar.textContent = '🟢 リアルタイム解析中 — カメラの前でエクササイズを行ってください';
  } catch(e) {
    loadingMsg.innerHTML = `<div style="color:#f88">エラー: ${e.message}</div>`;
    statusBar.style.display = 'none';
  }
}

async function loadVideo(event) {
  const file = event.target.files[0];
  if (!file) return;
  const video = document.getElementById('input-video');
  const loadingMsg = document.getElementById('loadingMsg');
  const statusBar = document.getElementById('statusBar');

  loadingMsg.innerHTML = '<div class="spinner"></div><div>AIモデルを読み込み中...</div>';
  loadingMsg.style.display = 'flex';
  statusBar.style.display = 'block';
  statusBar.textContent = 'MediaPipe Poseを初期化中...';

  await initPose();

  const url = URL.createObjectURL(file);
  video.src = url;
  video.style.display = 'block';
  loadingMsg.style.display = 'none';

  camera = new Camera(video, {
    onFrame: async () => { await pose.send({ image: video }); },
  });
  camera.start();
  video.play();

  statusBar.textContent = '🟢 動画解析中';
}

updateTips();
</script>

<?php include '../footer.php'; ?>
