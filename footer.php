<?php
// 🩷 Valentine's hearts animation
$valentine_end = strtotime('2026-02-21');
if (time() < $valentine_end): ?>
<script>
(function() {
  var container = document.getElementById('hearts');
  if (!container) return;
  var emojis = ['💗', '💕', '💖', '🩷', '♥️', '💘'];
  var count = 15;
  for (var i = 0; i < count; i++) {
    var span = document.createElement('span');
    span.className = 'heart';
    span.textContent = emojis[Math.floor(Math.random() * emojis.length)];
    span.style.left = Math.random() * 100 + '%';
    span.style.fontSize = (14 + Math.random() * 18) + 'px';
    span.style.animationDuration = (6 + Math.random() * 8) + 's';
    span.style.animationDelay = Math.random() * 10 + 's';
    container.appendChild(span);
  }
})();
</script>
<?php endif; ?>
</body>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QDYR9GB6SV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QDYR9GB6SV');
</script>

</html>