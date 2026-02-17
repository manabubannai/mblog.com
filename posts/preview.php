<?php
$page_title = "プレビュー — スマホ表示確認";
$page_description = "記事の下書きプレビュー（スマホ幅）";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>📱 プレビュー</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: #e8e8e8;
      font-family: -apple-system, BlinkMacSystemFont, sans-serif;
      padding: 20px;
    }
    .preview-controls {
      max-width: 700px; margin: 0 auto 20px;
    }
    .preview-controls textarea {
      width: 100%; min-height: 280px;
      font-family: Menlo, Monaco, monospace; font-size: 14px;
      padding: 15px; border: 1px solid #ccc; border-radius: 8px;
      resize: vertical; line-height: 1.6;
    }
    .toolbar {
      display: flex; gap: 10px; align-items: center; margin-top: 10px; flex-wrap: wrap;
    }
    .toolbar button {
      padding: 8px 16px; border: none; border-radius: 6px;
      background: #333; color: #fff; font-size: 13px; cursor: pointer;
    }
    .toolbar button:hover { background: #555; }
    .toolbar .size-btn {
      background: #fff; color: #333; border: 1px solid #ccc;
    }
    .toolbar .size-btn.active {
      background: #333; color: #fff;
    }
    .meta { font-size: 12px; color: #888; }
    .label { font-size: 13px; color: #666; font-weight: 600; margin-bottom: 8px; display: block; }

    /* Phone frame */
    .phone-frame {
      width: 393px; margin: 0 auto;
      background: #000; border-radius: 40px;
      padding: 20px 12px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }
    .phone-screen {
      background: #fff; border-radius: 28px;
      overflow-y: auto; padding: 0 5%;
      max-height: 80vh;
    }

    /* ===== old.mblog.com article styles (JP) ===== */
    .article {
      font-family: Noto, "Noto Sans JP", "Hiragino Sans", Helvetica, Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
      line-height: 2;
      color: rgb(51, 51, 51);
      padding: 25px 0;
    }
    .article h1 {
      font-size: 20px; font-weight: 600;
      margin-top: 0; margin-bottom: 20px; line-height: 1.7;
    }
    .article h2 {
      font-size: 19px; font-weight: 600;
      margin-top: 40px; margin-bottom: 15px; line-height: 1.7;
    }
    .article h2::before { content: "■ "; }
    .article h3 {
      font-size: 17px; font-weight: 600;
      margin-top: 40px; margin-bottom: 15px; line-height: 1.7;
    }
    .article h3::before { content: "□ "; }
    .article h4 {
      font-size: 16px; font-weight: 600;
      margin-top: 40px; margin-bottom: -5px; line-height: 1.7;
    }
    .article h4::before { content: "✓ "; }
    .article p {
      font-size: 15px; line-height: 1.7;
      margin-top: 15px; margin-bottom: 35px;
    }
    .article ul, .article ol {
      font-size: 14.7px; line-height: 2;
      background-color: rgba(250,250,250,0.48);
      outline: 1px solid rgba(228,228,228,0.87);
      padding: 20px 10px 20px 30px;
      margin-top: 15px; margin-bottom: 35px;
      list-style: disc;
    }
    .article ul li { line-height: 2; }
    .article blockquote {
      padding-left: 20px;
      border-left: 2.5px solid rgba(86,86,86,0.85);
      font-style: italic;
      margin: 15px 0 35px;
    }
    .article blockquote p {
      margin: 0; font-size: 15px;
    }
    .article blockquote p::before { content: "» "; }
    .article a { color: #337ab7; text-decoration: underline; }
    .article img { max-width: 100%; display: block; margin: auto; margin-bottom: 25px; }
    .article .placeholder-img {
      background: #f0f0f0; border: 2px dashed #ccc;
      padding: 30px; text-align: center; color: #999;
      font-size: 13px; border-radius: 8px;
      margin: 15px 0 25px;
    }
  </style>
</head>
<body>
  <div class="preview-controls">
    <span class="label">📱 スマホプレビュー — old.mblog.com スタイル準拠</span>
    <textarea id="draft" placeholder="ここに下書きテキストを貼り付け...

■ → h2見出し
□ → h3見出し
> → 引用（blockquote）
・ or - → リスト項目
>> 画像 → 画像プレースホルダー
空行 → 段落の区切り"></textarea>
    <div class="toolbar">
      <button onclick="renderPreview()">プレビュー更新</button>
      <button class="size-btn active" onclick="setSize(393, this)">iPhone 15</button>
      <button class="size-btn" onclick="setSize(360, this)">小型</button>
      <button class="size-btn" onclick="setSize(430, this)">Max</button>
      <span class="meta" id="charCount">0文字</span>
    </div>
  </div>
  <div class="phone-frame" id="phoneFrame">
    <div class="phone-screen">
      <div class="article" id="preview">
        <p style="color:#aaa; text-align:center; margin-top:60px;">↑ テキストを貼り付けてください</p>
      </div>
    </div>
  </div>

  <script>
    const textarea = document.getElementById('draft');
    const preview = document.getElementById('preview');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', () => {
      charCount.textContent = textarea.value.length + '文字';
    });
    textarea.addEventListener('paste', () => {
      setTimeout(renderPreview, 50);
    });

    function setSize(w, btn) {
      document.getElementById('phoneFrame').style.width = w + 'px';
      document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    function renderPreview() {
      const text = textarea.value;
      if (!text.trim()) {
        preview.innerHTML = '<p style="color:#aaa;text-align:center;">テキストを入力してください</p>';
        return;
      }

      const lines = text.split('\n');
      let html = '';
      let inList = false;
      let inBlockquote = false;
      let pendingP = [];

      function flushP() {
        if (pendingP.length > 0) {
          html += '<p>' + pendingP.join('<br>') + '</p>';
          pendingP = [];
        }
      }
      function closeList() {
        if (inList) { html += '</ul>'; inList = false; }
      }
      function closeBlockquote() {
        if (inBlockquote) { html += '</blockquote>'; inBlockquote = false; }
      }

      for (let i = 0; i < lines.length; i++) {
        const line = lines[i];
        const trimmed = line.trim();

        // Empty line = paragraph break
        if (trimmed === '' || trimmed === '〜〜') {
          flushP(); closeList(); closeBlockquote();
          continue;
        }

        // Image placeholder
        if (trimmed.startsWith('>> 画像') || trimmed.startsWith('>>画像')) {
          flushP(); closeList(); closeBlockquote();
          html += '<div class="placeholder-img">📷 画像</div>';
          continue;
        }

        // Blockquote
        if (trimmed.startsWith('>') || trimmed.startsWith('＞')) {
          flushP(); closeList();
          if (!inBlockquote) { html += '<blockquote>'; inBlockquote = true; }
          html += '<p>' + esc(trimmed.replace(/^[>＞]\s*/, '')) + '</p>';
          continue;
        }
        closeBlockquote();

        // h2 (■)
        if (trimmed.startsWith('■')) {
          flushP(); closeList();
          html += '<h2>' + esc(trimmed.replace(/^■\s*/, '')) + '</h2>';
          continue;
        }
        // h3 (□)
        if (trimmed.startsWith('□')) {
          flushP(); closeList();
          html += '<h3>' + esc(trimmed.replace(/^□\s*/, '')) + '</h3>';
          continue;
        }
        // h4 (✓)
        if (trimmed.startsWith('✓')) {
          flushP(); closeList();
          html += '<h4>' + esc(trimmed.replace(/^✓\s*/, '')) + '</h4>';
          continue;
        }

        // List item
        if (trimmed.match(/^[・\-\*]\s/)) {
          flushP();
          if (!inList) { html += '<ul>'; inList = true; }
          html += '<li>' + esc(trimmed.replace(/^[・\-\*]\s*/, '')) + '</li>';
          continue;
        }
        closeList();

        // Regular text → collect into paragraph
        pendingP.push(esc(trimmed));
      }
      flushP(); closeList(); closeBlockquote();

      preview.innerHTML = html;
      charCount.textContent = textarea.value.length + '文字';
    }

    function esc(s) {
      return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }
  </script>
</body>
</html>
