<?php
// ③ Cache headers (static-ish pages)
if (!headers_sent()) {
	header('Cache-Control: public, max-age=300, stale-while-revalidate=86400');
	header('Vary: Accept-Encoding');
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?= $page_title ?? 'manablog' ?></title>
	<?php if (!empty($page_description)): ?>
	<meta name="description" content="<?= htmlspecialchars($page_description) ?>">
	<?php endif; ?>
	<?php if (!empty($page_title)): ?>
	<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
	<meta property="og:type" content="article">
	<?php endif; ?>
	<?php if (!empty($page_description)): ?>
	<meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
	<?php endif; ?>
	<meta property="og:site_name" content="manablog">
	<!-- ① Preconnect + font-display for Typekit & Google Fonts -->
	<link rel="preconnect" href="https://use.typekit.net" crossorigin>
	<link rel="preconnect" href="https://p.typekit.net" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" media="print" onload="this.media='all'">
	<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap"></noscript>
	<link rel="stylesheet" href="https://use.typekit.net/jkb4xph.css" media="print" onload="this.media='all'">
	<noscript><link rel="stylesheet" href="https://use.typekit.net/jkb4xph.css"></noscript>
	<!-- ① Inline critical CSS -->
	<style>
body{max-width:650px;font-size:16px;margin:auto;padding:20px;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility}
h1.brand,p.brand{font-family:Sukhumvit Sukhumvit Set,serif;font-size:28px;font-weight:600;letter-spacing:.3px;margin-top:12px;margin-bottom:25px}
h1.brand a,p.brand a{text-decoration:none;color:#333}
ul{line-height:1.6}
ul.toppage{font-size:16.5px;list-style:none;padding:0;background-color:#fff;outline:none}
ul.toppage li{display:flex;padding:3px 0}
@media all and (max-width:480px){ul.toppage li{padding:5px 0}}
time{flex:0 0 105px}a{flex:1}
h1,h2,h3,time,p,li,pre{font-family:"adelle",Noto,"Hiragino Sans","Hiragino Kaku Gothic ProN","Yu Gothic",Meiryo,serif;font-style:normal;font-weight:400;color:#525150}
h1.title{font-size:27px;margin-top:25px;margin-bottom:27px;font-weight:600;color:#454545}
h2,h3{font-weight:600}
p{font-size:20px;line-height:1.75}
a{color:#2121d3d9}
img{max-width:85%;margin:auto;display:block}
hr{background-color:rgba(0,0,0,.15);height:1px;border:0;margin:25px 0}
ul,pre{font-size:16.5px;background-color:#f8f8f8;outline:1px solid rgba(228,228,228,.87);list-style:disc;padding:20px 20px 21px 30px}
li{display:list-item}
ul.long_list li:not(:last-child){margin-bottom:10px}ul.long_list li:last-child{margin-bottom:0}
pre{white-space:pre-wrap}
pre a{color:#2121d3d9;text-decoration:underline;text-underline-offset:3px}
blockquote{margin:20px 0 20px 2px;padding:0 0 0 15px;border-left:2px solid rgba(75,75,75,.8)}
blockquote p{font-size:17px;font-style:italic;color:#6a6a6a}
blockquote p:before{content:"» "}
.jp-article{color:#333}
.jp-article h1.brand,.jp-article p.brand{font-family:Sukhumvit Sukhumvit Set,serif!important;font-size:28px;font-weight:600;letter-spacing:.3px;margin-top:12px;margin-bottom:25px}
.jp-article h1.title,.jp-article h2,.jp-article h3,.jp-article p,.jp-article li,.jp-article time{font-family:"Hiragino Sans","Hiragino Kaku Gothic ProN","Noto Sans JP","Yu Gothic",Meiryo,Helvetica,Arial,sans-serif;letter-spacing:0}
.jp-article h1.title{font-weight:700;line-height:1.4;font-size:24px;margin-bottom:35px;color:#333}
.jp-article h2{font-size:20px;font-weight:700;margin-top:40px;margin-bottom:20px;padding-bottom:0;color:#333}
.jp-article h3,.jp-article time,.jp-article p,.jp-article li{color:#333}
.jp-article p{font-size:16px;line-height:1.9;margin-bottom:1.8em;letter-spacing:0}
.jp-article ul,.jp-article li{font-size:15.5px;line-height:1.8}
.jp-article pre{font-family:Menlo,Monaco,Consolas,"Courier New",monospace;font-size:13.5px;background-color:#f7f7f7;border:1px solid #eee;border-radius:4px;color:#333}
@media(min-width:768px){p{font-size:17px}img{max-width:60%}}
@media(max-width:767px){p{font-size:17px}ul{font-size:16.5px;line-height:1.6}.jp-article pre{padding:15px!important;word-break:break-all}}
	</style>
	<link rel="shortcut icon" href="https://manablog.org/wp-content/themes/manabu/images/favicon.ico">
</head>

<body>
