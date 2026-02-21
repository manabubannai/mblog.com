
<!-- Dark mode toggle button -->
<button id="dark-toggle" onclick="mblogToggleTheme()" aria-label="ダークモード切り替え" title="ダークモード切り替え">🌙</button>
<script>
function mblogToggleTheme(){
  var html=document.documentElement;
  var isDark=html.getAttribute('data-theme')==='dark';
  var next=isDark?'light':'dark';
  html.setAttribute('data-theme',next);
  localStorage.setItem('mblog-theme',next);
  document.getElementById('dark-toggle').textContent=isDark?'🌙':'☀️';
}
(function(){
  var t=localStorage.getItem('mblog-theme');
  var d=window.matchMedia&&window.matchMedia('(prefers-color-scheme:dark)').matches;
  var isDark=(t==='dark')||(t!=='light'&&d);
  var btn=document.getElementById('dark-toggle');
  if(btn)btn.textContent=isDark?'☀️':'🌙';
})();
</script>

</body>

<!-- ④ GA deferred loading -->
<script>
(function(){
  var d=document,s;
  function loadGA(){
    s=d.createElement('script');
    s.src='https://www.googletagmanager.com/gtag/js?id=G-QDYR9GB6SV';
    s.async=true;
    d.head.appendChild(s);
    window.dataLayer=window.dataLayer||[];
    function gtag(){dataLayer.push(arguments);}
    gtag('js',new Date());
    gtag('config','G-QDYR9GB6SV');
  }
  if(d.readyState==='complete'){setTimeout(loadGA,100);}
  else{window.addEventListener('load',function(){setTimeout(loadGA,100);});}
})();
</script>

</html>
