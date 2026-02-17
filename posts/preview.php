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
  <link rel="stylesheet" href="/style.css">
  <style>
    /* Preview-specific styles */
    * { box-sizing: border-box; }
    body {
      margin: 0; padding: 20px;
      background: #e8e8e8;
      font-family: -apple-system, BlinkMacSystemFont, sans-serif;
      max-width: 100%;
    }
    .preview-controls {
      max-width: 700px; margin: 0 auto 20px;
      display: flex; gap: 10px; align-items: center; flex-wrap: wrap;
    }
    .preview-controls textarea {
      width: 100%; min-height: 300px;
      font-family: Menlo, Monaco, monospace; font-size: 14px;
      padding: 15px; border: 1px solid #ccc; border-radius: 8px;
      resize: vertical; line-height: 1.6;
    }
    .preview-controls button {
      padding: 10px 20px; border: none; border-radius: 6px;
      background: #333; color: #fff; font-size: 14px; cursor: pointer;
    }
    .preview-controls button:hover { background: #555; }
    .preview-controls .size-btn {
      background: #fff; color: #333; border: 1px solid #ccc;
    }
    .preview-controls .size-btn.active {
      background: #333; color: #fff;
    }
    .phone-frame {
      width: 393px; /* iPhone 15 Pro width */
      margin: 0 auto;
      background: #000; border-radius: 40px;
      padding: 20px 12px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }
    .phone-screen {
      background: #fff; border-radius: 28px;
      overflow-y: auto; padding: 20px;
      max-width: 650px;
      /* Apply site styles */
      font-family: "adelle", Noto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, serif;
      font-size: 16px; color: #525150;
    }
    .phone-screen pre {
      white-space: pre-wrap;
      font-size: 16.5px;
      background-color: #f8f8f8;
      outline: 1px solid rgba(228,228,228,0.87);
      padding: 20px 20px 21px 30px;
      font-family: "adelle", Noto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, serif;
      font-style: normal; font-weight: 400; color: #525150;
    }
    .phone-screen p {
      font-size: 17px; line-height: 1.75; color: #525150;
      font-family: "adelle", Noto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, serif;
    }
    .phone-screen blockquote {
      margin: 20px 0 20px 2px; padding: 0 0 0 15px;
      border-left: 2px solid rgba(75,75,75,0.8);
    }
    .phone-screen blockquote p {
      font-size: 17px; font-style: italic; color: #6a6a6a;
    }
    .phone-screen blockquote p::before { content: "» "; }
    .phone-screen h1 { font-size: 27px; font-weight: 600; color: #454545; margin-top: 25px; margin-bottom: 27px; }
    .phone-screen h2 { font-weight: 600; color: #525150; }
    .phone-screen img { max-width: 100%; }
    .char-count { font-size: 13px; color: #888; }
    .label { font-size: 13px; color: #666; font-weight: 600; }
  </style>
</head>
<body>
  <div class="preview-controls">
    <span class="label">📱 スマホプレビュー — 下書きを貼って確認</span>
    <textarea id="draft" placeholder="ここに下書きテキストを貼り付け...

・改行はそのまま反映されます
・> で始まる行は引用（blockquote）になります
・□ や ■ で始まる行は見出しになります
・空行は段落の区切りになります"></textarea>
    <div style="display:flex; gap:10px; align-items:center; width:100%;">
      <button onclick="renderPreview()">プレビュー更新</button>
      <button class="size-btn active" onclick="setSize(393, this)">iPhone 15</button>
      <button class="size-btn" onclick="setSize(360, this)">小型</button>
      <button class="size-btn" onclick="setSize(430, this)">Max</button>
      <span class="char-count" id="charCount">0文字</span>
    </div>
  </div>
  <div class="phone-frame" id="phoneFrame">
    <div class="phone-screen" id="preview">
      <p style="color:#aaa; text-align:center; margin-top:40px;">↑ 上のテキストエリアに<br>下書きを貼り付けてください</p>
    </div>
  </div>

  <script>
    const textarea = document.getElementById('draft');
    const preview = document.getElementById('preview');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', () => {
      charCount.textContent = textarea.value.length + '文字';
    });

    // Auto-render on paste
    textarea.addEventListener('paste', () => {
      setTimeout(() => { renderPreview(); }, 50);
    });

    function setSize(w, btn) {
      document.getElementById('phoneFrame').style.width = w + 'px';
      document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    function renderPreview() {
      const text = textarea.value;
      if (!text.trim()) { preview.innerHTML = '<p style="color:#aaa;text-align:center;">テキストを入力してください</p>'; return; }

      const lines = text.split('\n');
      let html = '';
      let inPre = false;
      let inBlockquote = false;

      for (let i = 0; i < lines.length; i++) {
        const line = lines[i];
        const trimmed = line.trim();

        // Handle <pre> blocks
        if (trimmed === '<pre>') { inPre = true; html += '<pre>'; continue; }
        if (trimmed === '</pre>') { inPre = false; html += '</pre>'; continue; }
        if (inPre) { html += escapeHtml(line) + '\n'; continue; }

        // Empty line
        if (trimmed === '') {
          if (inBlockquote) { html += '</blockquote>'; inBlockquote = false; }
          html += '<br>';
          continue;
        }

        // Blockquote (> lines)
        if (trimmed.startsWith('>') || trimmed.startsWith('＞')) {
          if (!inBlockquote) { html += '<blockquote>'; inBlockquote = true; }
          html += '<p>' + escapeHtml(trimmed.replace(/^[>＞]\s*/, '')) + '</p>';
          continue;
        }
        if (inBlockquote) { html += '</blockquote>'; inBlockquote = false; }

        // Headings (■ □)
        if (trimmed.startsWith('■') || trimmed.startsWith('□')) {
          html += '<h2>' + escapeHtml(trimmed) + '</h2>';
          continue;
        }

        // Title marker
        if (trimmed.startsWith('##')) {
          html += '<h2>' + escapeHtml(trimmed.replace(/^#+\s*/, '')) + '</h2>';
          continue;
        }

        // List items (・ - *)
        if (trimmed.match(/^[・\-\*]\s*/)) {
          html += '<p style="padding-left:1em;text-indent:-1em;">' + escapeHtml(trimmed) + '</p>';
          continue;
        }

        // Regular paragraph
        html += '<p>' + escapeHtml(trimmed) + '</p>';
      }
      if (inBlockquote) html += '</blockquote>';

      preview.innerHTML = html;
      charCount.textContent = textarea.value.length + '文字';
    }

    function escapeHtml(str) {
      return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }
  </script>
</body>
</html>
