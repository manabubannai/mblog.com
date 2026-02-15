<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>manablog</title>
	<link rel="stylesheet" href="https://use.typekit.net/jkb4xph.css">
	<link rel="stylesheet" href="/style.css">
	<link rel="shortcut icon" href="https://manablog.org/wp-content/themes/manabu/images/favicon.ico">
</head>

<body>
<?php
// 🩷 Valentine's Day decoration (期間限定: ~2/20)
$valentine_end = strtotime('2026-02-21');
if (time() < $valentine_end): ?>
<style>
  /* Floating hearts */
  .valentine-hearts {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 9999;
    overflow: hidden;
  }
  .valentine-hearts .heart {
    position: absolute;
    top: -5%;
    font-size: 20px;
    animation: fall linear forwards;
    opacity: 0.7;
  }
  @keyframes fall {
    0%   { transform: translateY(0) rotate(0deg); opacity: 0.7; }
    100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
  }
  /* Subtle pink tint on brand */
  h1.brand a, p.brand a {
    color: #d4456a !important;
    transition: color 0.3s;
  }
  h1.brand a:hover, p.brand a:hover {
    color: #e8779a !important;
  }
  /* Top banner */
  .valentine-banner {
    text-align: center;
    font-size: 14px;
    color: #d4456a;
    padding: 8px 0 2px;
    font-family: "adelle", serif;
    letter-spacing: 0.5px;
    opacity: 0.85;
  }
</style>
<div class="valentine-banner">💝 Happy Valentine's 💝</div>
<div class="valentine-hearts" id="hearts"></div>
<?php endif; ?>