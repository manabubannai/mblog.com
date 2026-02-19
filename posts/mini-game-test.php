<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Catch the Dumbbells</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    background: #0f0f1a;
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
    touch-action: none;
    -webkit-user-select: none;
    user-select: none;
  }
  canvas { display: block; }
  #ui {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 16px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
    z-index: 10;
  }
  #ui span {
    color: #e0e0e0;
    font-size: 20px;
    font-weight: 600;
    text-shadow: 0 2px 8px rgba(0,0,0,.6);
  }
  #lives span { color: #ff4466; }
  #gameOver {
    display: none;
    position: absolute;
    inset: 0;
    background: rgba(10, 10, 26, .92);
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 20;
  }
  #gameOver.show { display: flex; }
  #gameOver h1 {
    color: #fff;
    font-size: 48px;
    margin-bottom: 12px;
  }
  #gameOver p {
    color: #aaa;
    font-size: 24px;
    margin-bottom: 36px;
  }
  #gameOver button {
    background: linear-gradient(135deg, #6c5ce7, #a855f7);
    color: #fff;
    border: none;
    padding: 14px 48px;
    font-size: 20px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    transition: transform .15s, box-shadow .15s;
    box-shadow: 0 4px 20px rgba(168, 85, 247, .4);
  }
  #gameOver button:hover { transform: scale(1.05); box-shadow: 0 6px 28px rgba(168, 85, 247, .6); }
</style>
</head>
<body>
<canvas id="c"></canvas>
<div id="ui">
  <span id="score">Score: 0</span>
  <span id="lives"></span>
</div>
<div id="gameOver">
  <h1>Game Over</h1>
  <p id="finalScore"></p>
  <button id="restartBtn">Play Again</button>
</div>
<script>
(() => {
  const canvas = document.getElementById('c');
  const ctx = canvas.getContext('2d');
  const scoreEl = document.getElementById('score');
  const livesEl = document.getElementById('lives');
  const gameOverEl = document.getElementById('gameOver');
  const finalScoreEl = document.getElementById('finalScore');
  const restartBtn = document.getElementById('restartBtn');

  let W, H;
  function resize() {
    W = canvas.width = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resize);
  resize();

  const PLAYER_W = 60;
  const PLAYER_H = 20;
  const PLAYER_SPEED = 7;
  const ITEM_SIZE = 32;
  const SPAWN_INTERVAL_MIN = 500;
  const SPAWN_INTERVAL_MAX = 1200;
  const FALL_SPEED_MIN = 2.5;
  const FALL_SPEED_MAX = 5;
  const BURGER_CHANCE = 0.3;

  let player, items, score, lives, gameRunning, lastSpawn, nextSpawn, keys, touchSide;
  let particles;
  let speedMultiplier;

  function init() {
    player = { x: W / 2, w: PLAYER_W, h: PLAYER_H };
    items = [];
    particles = [];
    score = 0;
    lives = 3;
    gameRunning = true;
    lastSpawn = 0;
    nextSpawn = 800;
    keys = {};
    touchSide = 0;
    speedMultiplier = 1;
    gameOverEl.classList.remove('show');
    updateUI();
  }

  function updateUI() {
    scoreEl.textContent = 'Score: ' + score;
    let h = '';
    for (let i = 0; i < 3; i++) h += '<span>' + (i < lives ? '\u2764' : '\u2661') + '</span> ';
    livesEl.innerHTML = h;
  }

  function spawnItem(now) {
    if (now - lastSpawn < nextSpawn) return;
    lastSpawn = now;
    nextSpawn = SPAWN_INTERVAL_MIN + Math.random() * (SPAWN_INTERVAL_MAX - SPAWN_INTERVAL_MIN);
    // speed up spawns as score increases
    nextSpawn *= Math.max(0.4, 1 - score / 500);

    const isBurger = Math.random() < BURGER_CHANCE;
    items.push({
      x: ITEM_SIZE / 2 + Math.random() * (W - ITEM_SIZE),
      y: -ITEM_SIZE,
      speed: (FALL_SPEED_MIN + Math.random() * (FALL_SPEED_MAX - FALL_SPEED_MIN)) * speedMultiplier,
      type: isBurger ? 'burger' : 'dumbbell',
      emoji: isBurger ? '\uD83C\uDF54' : '\uD83C\uDFCB\uFE0F',
      size: ITEM_SIZE
    });
  }

  function spawnParticles(x, y, color, count) {
    for (let i = 0; i < count; i++) {
      const angle = Math.random() * Math.PI * 2;
      const speed = 1 + Math.random() * 4;
      particles.push({
        x, y,
        vx: Math.cos(angle) * speed,
        vy: Math.sin(angle) * speed - 2,
        life: 1,
        decay: 0.02 + Math.random() * 0.03,
        color,
        r: 2 + Math.random() * 3
      });
    }
  }

  function update(now) {
    // player movement
    let dx = 0;
    if (keys['ArrowLeft'] || keys['a']) dx -= 1;
    if (keys['ArrowRight'] || keys['d']) dx += 1;
    dx += touchSide;
    player.x += dx * PLAYER_SPEED;
    player.x = Math.max(player.w / 2, Math.min(W - player.w / 2, player.x));

    // speed ramp
    speedMultiplier = 1 + score / 300;

    // spawn
    spawnItem(now);

    // items
    const playerTop = H - 50 - player.h;
    const playerLeft = player.x - player.w / 2;
    const playerRight = player.x + player.w / 2;

    for (let i = items.length - 1; i >= 0; i--) {
      const it = items[i];
      it.y += it.speed;

      // collision
      const itBottom = it.y + it.size / 2;
      const itTop = it.y - it.size / 2;
      const itLeft = it.x - it.size / 2;
      const itRight = it.x + it.size / 2;

      if (itBottom >= playerTop && itTop <= playerTop + player.h &&
          itRight >= playerLeft && itLeft <= playerRight) {
        if (it.type === 'dumbbell') {
          score += 10;
          spawnParticles(it.x, it.y, '#a855f7', 12);
        } else {
          lives--;
          spawnParticles(it.x, it.y, '#ff4466', 16);
          if (lives <= 0) {
            gameRunning = false;
            finalScoreEl.textContent = 'Final Score: ' + score;
            gameOverEl.classList.add('show');
          }
        }
        items.splice(i, 1);
        updateUI();
        continue;
      }

      // off screen
      if (it.y > H + it.size) {
        items.splice(i, 1);
      }
    }

    // particles
    for (let i = particles.length - 1; i >= 0; i--) {
      const p = particles[i];
      p.x += p.vx;
      p.y += p.vy;
      p.vy += 0.1;
      p.life -= p.decay;
      if (p.life <= 0) particles.splice(i, 1);
    }
  }

  function draw() {
    ctx.clearRect(0, 0, W, H);

    // subtle gradient bg
    const bg = ctx.createLinearGradient(0, 0, 0, H);
    bg.addColorStop(0, '#0f0f1a');
    bg.addColorStop(1, '#1a1a2e');
    ctx.fillStyle = bg;
    ctx.fillRect(0, 0, W, H);

    // ground line
    const groundY = H - 30;
    ctx.strokeStyle = 'rgba(168, 85, 247, 0.3)';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(0, groundY);
    ctx.lineTo(W, groundY);
    ctx.stroke();

    // player (platform)
    const py = H - 50;
    const px = player.x;
    ctx.save();
    ctx.shadowColor = '#a855f7';
    ctx.shadowBlur = 18;
    const grad = ctx.createLinearGradient(px - player.w / 2, py, px + player.w / 2, py);
    grad.addColorStop(0, '#6c5ce7');
    grad.addColorStop(1, '#a855f7');
    ctx.fillStyle = grad;
    ctx.beginPath();
    ctx.roundRect(px - player.w / 2, py, player.w, player.h, 6);
    ctx.fill();
    ctx.restore();

    // player emoji on platform
    ctx.font = '22px serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'bottom';
    ctx.fillText('\uD83E\uDDD1', px, py - 1);

    // items
    ctx.font = ITEM_SIZE + 'px serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    for (const it of items) {
      ctx.fillText(it.emoji, it.x, it.y);
    }

    // particles
    for (const p of particles) {
      ctx.globalAlpha = p.life;
      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.globalAlpha = 1;
  }

  function loop(now) {
    if (gameRunning) update(now);
    draw();
    requestAnimationFrame(loop);
  }

  // keyboard
  window.addEventListener('keydown', e => {
    keys[e.key] = true;
    if (['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown', ' '].includes(e.key)) e.preventDefault();
  });
  window.addEventListener('keyup', e => { keys[e.key] = false; });

  // touch
  function handleTouch(e) {
    if (!gameRunning) return;
    const t = e.touches[0];
    if (!t) { touchSide = 0; return; }
    touchSide = t.clientX < W / 2 ? -1 : 1;
  }
  window.addEventListener('touchstart', handleTouch);
  window.addEventListener('touchmove', handleTouch);
  window.addEventListener('touchend', () => { touchSide = 0; });
  window.addEventListener('touchcancel', () => { touchSide = 0; });

  // restart
  restartBtn.addEventListener('click', init);

  init();
  requestAnimationFrame(loop);
})();
</script>
</body>
</html>
