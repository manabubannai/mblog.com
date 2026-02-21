<?php
$page_title = 'Dark Mode Test — mblog.com';
$page_description = 'ダークモード表示確認ページ。全記事のリンクから各ページでデザインを確認できます。';
require dirname(__DIR__) . '/header.php';
?>

<p class="brand"><a href="https://mblog.com/">manablog</a></p>
<time>Dark Mode Test</time>
<h1 class="title">🌙 ダークモード — 全記事確認ページ</h1>

<p>右下の 🌙 ボタンでダーク/ライトを切り替え。設定はリロード後も維持されます。下のリンクから各ページのデザインを確認してください。</p>

<hr>

<h2>Health Log</h2>
<ul>
  <li><a href="/health-log" target="_blank">Health Log（毎日更新）</a></li>
</ul>

<h2>How-to</h2>
<ul>
  <li><a href="/how-to-set-up-openclaw" target="_blank">OpenClaw のセットアップ方法</a></li>
  <li><a href="/openclaw-setup" target="_blank">How to Set Up OpenClaw (English)</a></li>
  <li><a href="/how-to-meditate" target="_blank">瞑想のやり方</a></li>
</ul>

<h2>Opinion</h2>
<ul>
  <li><a href="/end-of-nomad-era" target="_blank">ノマド時代は終わりますね。通勤しよう</a></li>
  <li><a href="/drop-pc-grab-dumbbell" target="_blank">PCを捨てて、ダンベルを持て</a></li>
  <li><a href="/note-priority-redesign" target="_blank">優先順位の再設計</a></li>
</ul>

<h2>Review</h2>
<ul>
  <li><a href="/siddhartha-hermann-hesse-book-review" target="_blank">シッダールタ — ヘルマン・ヘッセ</a></li>
  <li><a href="/joy-by-osho-book-review" target="_blank">JOY — Osho</a></li>
  <li><a href="/intuition-by-osho-book-review" target="_blank">INTUITION — Osho</a></li>
  <li><a href="/dog-friendly-hotel-in-phitsanulok" target="_blank">犬連れで泊まれるホテル（ピッサヌローク）</a></li>
  <li><a href="/spiritual-trip-2025-12-30" target="_blank">スピリチュアルな旅 2025-12-30</a></li>
</ul>

<hr>

<pre>// ダークモード仕様
- prefers-color-scheme: dark に自動追従
- 🌙 ボタンで手動切り替え
- localStorage で設定を記憶
- 全ページで有効（dark-mode.css + header.php）</pre>

<p style="font-size:14px; opacity:0.5; margin-top:30px;">※ このページは確認用。本番適用後に削除します。</p>

<?php require dirname(__DIR__) . '/footer.php'; ?>
