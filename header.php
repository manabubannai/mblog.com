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
	<link rel="stylesheet" href="https://use.typekit.net/jkb4xph.css">
	<link rel="stylesheet" href="/style.css">
	<link rel="shortcut icon" href="https://manablog.org/wp-content/themes/manabu/images/favicon.ico">
</head>

<body>
<?php
<?php // Valentine's decoration removed 2026-02-18 ?>