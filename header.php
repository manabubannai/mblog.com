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
<!-- ① Base CSS -->
	<?php $cv = '20260221b'; ?>
	<link rel="stylesheet" href="/style.css?v=<?= $cv ?>">
	<?php if (!empty($extra_css)): ?>
	<?php foreach ($extra_css as $css): ?>
	<link rel="stylesheet" href="<?= $css ?>?v=<?= $cv ?>">
	<?php endforeach; ?>
	<?php endif; ?>
	<link rel="shortcut icon" href="https://manablog.org/wp-content/themes/manabu/images/favicon.ico">
</head>

<body>
