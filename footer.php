
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
