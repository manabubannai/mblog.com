<?php require dirname(__DIR__) . '/header.php'; ?>

<!-- 日本語のみに適応 -->
<style>
  .jp-font {
    font-family: Noto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 28px;
    color: #333;
    -webkit-font-smoothing: antialiased;
  }

  .health-section {
    font-family: Noto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 1.8;
    color: #333;
    -webkit-font-smoothing: antialiased;
  }

  pre {
    font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
    font-size: 13.5px;
    line-height: 1.6;
    padding: 15px !important;
    border: 1px solid #eee !important;
    border-radius: 4px;
    color: #333;
    white-space: pre-wrap;
  }
</style>
<script>
  window.onload = function () {
    // Copy AI prompt
    var copyPromptBtn = document.getElementById('copyPromptBtn');
    if (copyPromptBtn) {
      copyPromptBtn.addEventListener('click', function () {
        var promptEl = document.getElementById('ai-prompt');
        navigator.clipboard.writeText(promptEl.textContent.trim()).then(function () {
          copyPromptBtn.textContent = '✅ コピーしました！';
          setTimeout(function () { copyPromptBtn.textContent = '📋 プロンプトをコピー'; }, 2000);
        });
      });
    }
    document.querySelectorAll('pre').forEach(pre => {
      const regex = /([\u3040-\u309F\u30A0-\u30FF\u4E00-\u9FFF]+)/g;
      pre.innerHTML = pre.innerHTML.replace(regex, '<span class="jp-font">$1</span>');
    });
  };
</script>

<p class="brand"><a href="https://mblog.com/">manablog</a></p>
<time>11 Jan, 2026</time>
<h1 class="title">🌿 My Daily Health Log</h1>
<p class="health-section" style="background: #f0f7ff; border: 1px solid #c8ddf5; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #4a6a8a; margin-bottom: 16px;">
🤗 このページはAIパートナーと一緒に作っています。できるだけ正確に書いていますが、健康やサプリのことは自分の体と相談しながら参考にしてくださいね 🙏
</p>

<p style="
font-family: Noto, Hiragino Sans, Helvetica, Arial, sans-serif;
text-rendering: optimizeLegibility;
background: transparent;
-webkit-font-smoothing: antialiased;
line-height: 1.7;
font-weight: 600;
">⭐️ 2月の目標 : 姿勢を正す 🧍‍♂️✨</p>

<div id="copy-target">
  <p>This is my daily health log to improve my physical and mental health. I also want to maximize my workout results.
  </p>
  <p>I&#39;m making this public because it may be helpful for others and it&#39;s good for me to have some external
    pressure.</p>
  <ul>
    <li>Name: Manabu Bannai </li>
    <li>Date of Birth: 1990-05-24</li>
    <li>Location: Chiang Mai, Thailand </li>
    <li>Job: Ex-Influencer. Now I&#39;m resting</li>
  </ul>

  <p>
    <a id="copyBtn" style="text-decoration: underline; cursor: pointer;">» Click here to copy all the data</a><br>
    <a id="copyLast10Btn" style="text-decoration: underline; cursor: pointer;">» Click here to copy last 10 days</a>
  </p>

  <pre>
🎯 目的
・その① : Joyの最大化。あと暇だから 😊
・その② : バルクアップして、肉体美化 💪
・その③ : 肉体と精神エネルギーの強化 🧘
→最も効果の高い施策をAIに聞きつつ実行

📅 ルーティン
8時 : 起床 ☀️
9時：日光、朝食 🥣
10時：犬と遊ぶ、ストレッチ、Meditation 🐕
11時：自由時間（３時間 → 何でも可能）🎮
14時：昼食 🍛
15時：コーヒー ☕
16時：筋トレ 🏋️
20時：ディナー 🍽️
23時：読書やPodcast（画面オフ）📖
</pre>

  <!-- AI Health Log Prompt Section -->
  <div class="health-section" style="background: #f8f8f8; border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; margin: 20px 0;">
    <p style="font-weight: bold; font-size: 16px; margin-top: 0;">🍽️ AIで食事管理を始めてみよう</p>
    <p style="font-size: 14px; line-height: 1.7; color: #555; margin-bottom: 12px;">
      下のプロンプトをコピーして、AIに貼り付けるだけ ✨ 写真を送るだけの食事管理が始められます。<br>
      <strong>推奨AI：</strong> <a href="https://claude.ai" target="_blank">Claude Opus 4.6</a> / <a href="https://gemini.google.com" target="_blank">Gemini Pro</a>
    </p>
    <div style="position: relative;">
      <pre id="ai-prompt" style="font-size: 12px; line-height: 1.5; max-height: 200px; overflow-y: auto; background: #fff; cursor: text;">あなたは栄養管理AIアシスタントです。

■ 役割
ユーザーの食事を記録し、栄養科学に基づいたフィードバックを返します。

■ 食事ログのルール
- ユーザーが食事の写真やテキストを送ったら、以下のフォーマットで記録する
- カロリー・PFC（タンパク質/脂質/炭水化物）を推定する
- 1食ごとに [タグ] 付きのフィードバックを返す

■ フォーマット
Breakfast/Lunch/Dinner (時刻): メニュー [Total: ~〇〇kcal, P: 〇g, F: 〇g, C: 〇g]
*Feedback: [タグ] フィードバック本文

■ フィードバックのスタイル
- PFC（カロリー計算）だけでなく、栄養科学の視点で書く
- 微量栄養素（ビタミン、ミネラル）の吸収効率に言及
- 食材の組み合わせによる相乗効果を指摘
- 腸内環境、抗酸化、抗炎症の観点を含める
- 改善提案は具体的に（「野菜を増やせ」ではなく「パプリカを追加するとビタミンCが卵の鉄分吸収を2-3倍に高める」）

■ タグの例
[Choline Boost] — コリンが豊富な食事
[Omega-3 Rich] — オメガ3脂肪酸が豊富
[Gut Health] — 腸内環境に良い
[Glycemic Control] — 血糖値コントロールに配慮
[Protein Boost] — タンパク質が豊富
[Iron + B12] — 造血に必要な栄養素
[Antioxidant] — 抗酸化成分が豊富
[Comfort but Calorie-Dense] — 美味しいがカロリー注意
※食事内容に合わせて自由にタグを作ってOK

■ 1日の終わりに Daily Summary を出す
ユーザーが「まとめ」「今日の合計」などと言ったら：
- 総カロリー、総タンパク質
- ✓（良かった点）と ⚠️（改善点）をリストアップ
- 翌日への具体的アドバイス

■ 写真が送られた場合
- 画像から食材を特定する
- 不明な場合は確認する（「これは〇〇ですか？」）
- 量が分からない場合は一般的な1人前で推定する

■ トーン
- 簡潔。短文。
- 褒めるべきは褒める、改善点は正直に言う
- 専門用語を使いつつ、分かりやすく
- 日本語で返す

■ ユーザーの目標（カスタマイズ用）
- 目標: [バルクアップ / ダイエット / 健康維持]（ユーザーに聞く）
- 1日のカロリー目標: [ユーザーに聞く or 自動算出]
- アレルギー・制限: [ユーザーに聞く]</pre>
      <a id="copyPromptBtn" style="display: inline-block; margin-top: 10px; padding: 8px 20px; background: #111; color: #fff; border-radius: 6px; text-decoration: none; cursor: pointer; font-size: 14px;">📋 プロンプトをコピー</a>
    </div>
  </div>
  <!-- End AI Prompt Section -->

  <!-- Supplement Stack Section -->
  <div class="health-section" style="background: #f8f8f8; border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; margin: 20px 0;">
    <p style="font-weight: bold; font-size: 16px; margin-top: 0;">💊 僕が飲んでいるサプリ一覧</p>
    <p style="font-size: 13px; color: #888; margin-bottom: 16px;">毎朝、朝食と一緒に摂取しています。<br>※アフィリエイトリンクですが、利用者に割引が入るので使っています。使いたくない場合は、商品名で検索してください🙋‍♂️</p>
    <table style="width: 100%; border-collapse: collapse; font-size: 14px; line-height: 1.7;">
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">1. マルチビタミン</td>
        <td style="padding: 10px 0 10px 16px;">
          <a href="https://www.iherb.com/pr/thorne-multi-vitamin-elite-a-m-p-m-2-bottles-90-capsules-each/71156?rcode=AOK5109" target="_blank">Thorne Multi-Vitamin Elite AM &amp; PM</a><br>
          <span style="color: #666;">ベースとなるマルチビタミン。AM（朝用）は細胞エネルギー産生をサポート、PM（夜用）は睡眠の質を向上。Thorneは医療グレードの品質で信頼性が高い。</span>
        </td>
      </tr>
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">2. オメガ3</td>
        <td style="padding: 10px 0 10px 16px;">
          <a href="https://www.iherb.com/pr/nordic-naturals-ultimate-omega-lemon-60-soft-gels-640-mg-per-soft-gel/43654?rcode=AOK5109" target="_blank">Nordic Naturals Ultimate Omega（1280mg）</a><br>
          <span style="color: #666;">EPA/DHAで抗炎症・脳機能サポート。心臓血管の健康維持にも。Nordic Naturalsはフィッシュオイルブランドで全米No.1。</span>
        </td>
      </tr>
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">3. NMN</td>
        <td style="padding: 10px 0 10px 16px;">
          <a href="https://www.iherb.com/pr/prohealth-longevity-nmn-pro-complete-120-capsules/127502?rcode=AOK5109" target="_blank">ProHealth NMN Pro Complete</a>（NMN 1g / Resveratrol 1g / TMG 0.5g）<br>
          <span style="color: #666;">アンチエイジングの最前線。NMNがNAD+を補充し細胞のエネルギー産生を回復。レスベラトロールが長寿遺伝子（サーチュイン）を活性化。TMGがメチル化をサポート。この3つの組み合わせがポイント。</span>
        </td>
      </tr>
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">4. クレアチン</td>
        <td style="padding: 10px 0 10px 16px;">
          <a href="https://www.iherb.com/pr/thorne-creatine-16-oz-450-g/70006?rcode=AOK5109" target="_blank">Thorne Creatine（5g/日）</a><br>
          <span style="color: #666;">筋力・筋肉量の増加をサポート。実はバルクアップだけでなく、脳のエネルギー産生にも効果があり認知機能も向上する。最も研究エビデンスが豊富なサプリの1つ。</span>
        </td>
      </tr>
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">5. コラーゲン</td>
        <td style="padding: 10px 0 10px 16px;">
          <a href="https://www.iherb.com/pr/great-lakes-gelatin-co-collagen-hydrolysate-beef-16-oz-454-g/52774?rcode=AOK5109" target="_blank">Great Lakes Collagen Peptides（20g/日）</a><br>
          <span style="color: #666;">肌・髪・爪・関節のサポート。グラスフェド牛由来で品質が高い。ビタミンC（レモン汁）と一緒に摂ることでコラーゲン合成が促進される。</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; font-weight: bold; vertical-align: top; white-space: nowrap;">6. レモン汁</td>
        <td style="padding: 10px 0 10px 16px;">
          レモン汁（大さじ1）を水に溶かして<br>
          <span style="color: #666;">クエン酸がサプリに含まれる非ヘム鉄の吸収率を向上。ビタミンCがコラーゲン合成を促進。朝一番にサプリと一緒に飲む。</span>
        </td>
      </tr>
    </table>
  </div>

  <!-- 
下記は、サプリが届いたら記載する
■ Substances

1. Foundation
Omega3 EPA+DHA 1280 mg (Nordic)
Multi-Vitamin Elite (Thorne)

2. Performance
Creatine 5g (Thorne)
Collagen 20g (Great Lakes)
Ginseng 3600 mg (Jung Kwan Jang)
Ashwagandha 300 mg (Jarrow)

3. Longevity
NMN 1g / Res 1g / TMG 0.5g (ProHealth)
Calcium AKG 700 mg (Codeage)
Curcumin 500 mg (Thorne)
NAC 500 mg (Thorne)
-->

  <h2># 2026-02-15</h2>
  <pre>
- Sleep: 23:45 - 9:00
- Body: 10/10
- Mind: 10/10
- Spirit: 9/10

■ Food
- Breakfast: 3 Fried Eggs (Black Pepper), White Rice (~150g), Miso Soup (Wakame, Tofu, Bamboo Shoot, Aburaage), Cucumber Slices, Red &amp; Yellow Bell Pepper [Total: ~650kcal, P: 28g, F: 18g, C: 80g]
  *Feedback from AI: [Veggie Boost] 昨日の食物繊維不足を朝から補強 — きゅうりのカリウム+わかめの水溶性食物繊維で腸内環境ケア。パプリカのビタミンCは卵の鉄分吸収を2-3倍に高める好組み合わせ。卵3個でコリン450mg確保。味噌汁の発酵菌+わかめのフコイダンが免疫サポート。白米はライスベリーに替えると食物繊維+アントシアニンがさらにUP。

- Snack: EVOO (1 tbsp), 3 Seed Protein, Coconut Sugar (2 tsp) [Total: ~200kcal, P: 15g, F: 14g, C: 10g]
  *Feedback from AI: [Quick Fuel] ランチまでの繋ぎとして良い選択。EVOOのオレイン酸が血糖値の急上昇を抑え、プロテインで筋分解を防ぐ。ココナッツシュガーは白砂糖よりGI値が低く（35 vs 65）ミネラルも含む。
- Lunch (15:29): Protein Bowl — Air Fried Salmon 200g, Tempe 100g, Boiled Eggs x2, Edamame 40g, Broccoli 100g, Carrot 100g, Tomato 100g, Raw Beetroot 30g, Black Olive 20g, Jasmine Rice 100g, Mix Rice 100g, Mediterranean Garlic Dressing [Total: ~1050kcal, P: 78g, F: 32g, C: 95g]
  *Feedback from AI: [Perfect Bulk Meal] バルクアップの教科書的な1食。サーモン200gでEPA/DHA+タンパク質40g超、テンペの発酵菌が腸内環境を強化。ゆで卵2個でコリン300mg追加（朝と合わせて750mg、推奨量超え）。ブロッコリーのスルフォラファンが抗がん+解毒作用。ビーツの硝酸塩が一酸化窒素を産生し血流改善→筋トレ前の摂取として理想的。枝豆のイソフラボン+オリーブのオレイン酸で抗炎症。ミックスライスで食物繊維も確保。文句なし。

■ Substances
- Multi-Vitamin Elite AM (Thorne) with breakfast
- Omega-3 (Fish Oil) with breakfast
- NMN Pro Complete (ProHealth) — NMN 1g / Res 1g / TMG 0.5g with breakfast
- Lemon Juice in water（クエン酸で非ヘム鉄の吸収率向上）
- Great Lakes Collagen with breakfast
- Creatine (Thorne) with breakfast

■ Treatment
• Meditation 30min (午後に実施 — 朝一のタイミングを逃した)
• Stretch 20min

■ Note
トシさんに依頼してSimple Clawを作ってみる？
理由：世の中のサービスは怪しい。自分の信頼を使い、売れるかも？
→ それよりも、誰でもHealth Logを作れるアプリ/サービスを作る方が良さそう

スキルの定義が変わった：昔は人間が頑張って学んで知識を身につけることだった。今はAIに「そのスキルを学ぶためのステップバイステップのガイド」を渡すことがスキルであり、何故ならAIは一瞬でステップを学ぶので、新しいスキルの学習時間が不要。
「人間のスキル = 学習時間の投資」→「AIのスキル = プロンプト1枚」

中国製のSeedance 2.0（ByteDance）で自分のストレッチルーティンをYouTubeショート動画にしたい。まず自分のストレッチを全て撮影→AIに解析→ショート動画としてわかりやすく出力する構想。

メルマガのネタを考えるのがめんどうなので、全て「AI」に任せることにした。
AIとの会話のスクショを見せて、「マナブさんはもう諦めて、AIに人生をゆだねたのだ」と伝わるコンテンツを作る。
結果は、メルマガの伸びや、サプリのアフィリエイト収益などを公開する。透明性。
</pre>

  <h2># 2026-02-14</h2>
  <pre>
- Sleep: 23:00 - 8:00
- Body: 10/10
- Mind: 9/10
- Spirit: 8/10

■ Food
- Breakfast (09:37): 3 Fried Eggs, Riceberry (~150g), EVOO (1 tbsp), Yogurt (90g), Oats (25g), 3 Seed Protein, Great Lakes Collagen, Almond Milk (100ml), Coconut Sugar (2 tsp) [Total: ~965kcal, P: 49g, F: 35g, C: 91g]
  *Feedback from AI: [Choline Boost] 卵3個でコリン約450mg確保（1日推奨量の80%超）。ライスベリーは白米比で食物繊維3倍+アントシアニンの抗酸化効果。ただしタンパク質21gはバルクアップ朝食としては控えめ → Seed Protein or 豆腐の追加で改善。EVOOを加えると卵の脂溶性ビタミン（A/D/E）の吸収率が向上する。
- Lunch: Carbonara Pasta, Mushroom Cream Soup (half), White Fish Meunière (Herb Butter Sauce) w/ Mashed Potato (half) [Total: ~1150kcal, P: 52g, F: 43g, C: 115g]
  *Feedback from AI: [Protein Rescued] 白身魚追加でタンパク質52gに改善 — 魚のタンパク質は消化吸収率95%超で筋合成に効率的。ハーブバターのパセリにビタミンK+鉄分。マッシュルームのエルゴチオネイン（細胞保護）+魚のセレンで抗酸化を二重カバー。カルボナーラの飽和脂肪酸は多めだが、魚の不飽和脂肪酸が脂質バランスを改善。腹八分目で残したのは消化負担の軽減にも◎。

- Dinner: Gyudon (Beef Bowl w/ Onsen Egg, Green Onion), Miso Soup (Tofu, Green Onion), Beni Shoga, Tubtim Siam Pomelo (2-3 segments) [Total: ~820kcal, P: 35g, F: 25g, C: 105g]
  *Feedback from AI: [Iron + B12 Boost] 牛肉の赤身で吸収率の高いヘム鉄+ビタミンB12を確保（造血に必須）。温泉卵でコリン追加 — 朝の卵3個と合わせて1日推奨量を余裕で達成。味噌汁の発酵菌+豆腐のイソフラボンで腸内環境サポート。紅生姜のジンゲロールが消化促進+抗炎症。ネギのアリシンがビタミンB1の吸収を高め、牛肉のB1を効率的に活用。

■ Daily Summary (by AI)
  ✓ 総カロリー: ~2,935kcal（バルクアップ目標に適合）
  ✓ タンパク質: 136g（体重1kgあたり約1.9g — 筋合成に十分）
  ✓ コリン: 卵4個分で推奨量超え（認知機能+肝機能サポート）
  ✓ ヘム鉄: 牛肉+魚で吸収率の高い鉄を確保
  ✓ 発酵食品: 味噌汁で腸内環境ケア
  ✓ 抗酸化: ライスベリー+マッシュルーム+紅生姜
  ✓ 睡眠: 9時間（23:00-8:00）→ 理想的
  ⚠️ 食物繊維: やや少なめ（外食2食で野菜控えめ）→ 明日は意識的に補強
  ⚠️ オメガ3: 魚のメニエールで摂れたが昨日より控えめ
  → バレンタイン外食デーとしては十分な栄養バランス。タンパク質136gでバルクアップ継続🎯

■ Substances
- Creatine (Thorne) with breakfast
- NMN Pro Complete (ProHealth) — NMN 1g / Res 1g / TMG 0.5g with breakfast
- Multi-Vitamin Elite AM (Thorne) 2capsules with breakfast
- Omega-3 (1 capsule) with breakfast
- Cannabis 0.5g (Indica) at 21:00

■ Treatment
• Meditation (first thing in the morning)

■ Social
• Billiards with friend 🎱

■ Note
Dream: ルナ（犬）がリードなしで散歩してたらいなくなり、しかし後から庭に行ってみたら帰ってきてた。深い穴に落ちていたみたい。だけど、怪我せずに帰ってきていた。

Dream Analysis (by AI — Jungian Framework):
【元型】犬（ルナ）= 「本能」「忠実な影（Shadow）」の象徴。自己の中の直感的・本能的な側面。
【リードなし】= ペルソナ（社会的仮面）による統制を解除した状態。意識的コントロールを手放している。
【いなくなる】= 個性化（Individuation）の過程で、本能的な自己が一時的に意識から離れること。バーンアウト期に「自分が何を本当に望んでいるか」を見失った経験と共鳴する。
【深い穴に落ちる】= ネキア（Nekyia）— 冥界下降。無意識の深層への旅。ユングは「深みに降りることで、より完全な自己に近づく」と説いた。瞑想3年間の内省がこれに該当する。
【怪我なく帰還】= 自己（Self）の統合。深層に降りたが破壊されず、むしろ無傷で戻る。これは個性化の成功を示唆する — 失ったものは壊れておらず、変容して戻ってくる。
【総合】自分の本能的な部分を自由にしても（リードを外しても）、それは消えない。一時的に深い無意識の中に沈んでも、必ず戻ってくる。今のマナブさんが新しい活動を模索する中で、自分の直感を信頼してよいという無意識からのメッセージ。
</pre>

  <h2># 2026-02-13</h2>
  <pre>
- Sleep: 23:00 - 7:30
- Body: 10/10
- Mind: 10/10
- Spirit: 8/10

■ Food
- Breakfast (08:08): Rice (Large portion, ~250g), 3 Seed Protein (drink), Oats (40g), Tofu (100g), Honey (少々, ~10g), EVOO (1 tbsp), MCT Oil (1 tsp), Great Lakes Collagen, 整腸剤 [Total: ~870kcal, P: 43g, F: 27g, C: 110g]
  *Feedback from AI: [Glycemic Control + Protein Boost] オーツ40gのβグルカンが白米+蜂蜜の血糖スパイクを緩和。豆腐100g追加でタンパク質43gに改善 — 植物性イソフラボンが抗酸化+骨密度維持に寄与。動物性（コラーゲン）と植物性（豆腐/Seed Protein）の混合で必須アミノ酸を幅広くカバー。整腸剤+オーツの食物繊維で腸内環境の正常化を促進。
- Lunch (12:30): Sushiro — Negitoro (2 plates), Maguro (1 plate), Salmon (2 plates), Salmon w/ Cheese (1 plate), Udon, Chawanmushi, Asari Miso Soup [Total: ~1150kcal, P: 62g, F: 28g, C: 130g]
  *Feedback from AI: [Omega-3 Rich] マグロ+サーモン計6貫でEPA/DHA推定2g以上 — 抗炎症・脳機能に優秀。ネギトロのネギにアリシンが含まれ、ビタミンB1の吸収を促進。茶碗蒸しの卵でコリン確保。アサリは鉄分+ビタミンB12の優秀な供給源（造血に必須）。チーズ乗せでカルシウム+カゼインプロテインも追加。うどんの精製炭水化物が血糖を上げやすいが、味噌汁の食物繊維と脂質（魚の脂）が緩和。
- Dinner (20:11): Oden (Egg, Beef Tendon, Daikon, Chikuwa), Riceberry (~150g), Miso Soup (Wakame, Tofu), Bamboo Shoot &amp; Eringi Garlic Stir-fry, Tempeh w/ Grated Daikon (~85g, half portion), Sweet Potato Salad (Mayo, Raisins, Walnuts, Almonds — ~20% portion), Strawberries (8 pcs) [Total: ~890kcal, P: 36g, F: 22g, C: 130g]
  *Feedback from AI: [Gut Health &amp; Antioxidants] テンペの発酵菌（リゾプス）が腸内フローラを強化 — 味噌汁の発酵菌との相乗効果。大根おろしの消化酵素（ジアスターゼ）がテンペのタンパク質吸収を促進。ライスベリーは白米比で食物繊維3倍、アントシアニン（抗酸化）が豊富。牛すじのコラーゲン+朝のビタミンC（レモン汁）でコラーゲン合成を促進。くるみのオメガ3が昼のサーモンに加えてさらに抗炎症効果を強化。たけのこの不溶性食物繊維が腸の蠕動運動を促し、便の色の改善に寄与する可能性あり。

■ Daily Summary (by AI)
  ✓ 総カロリー: ~2,910kcal（バルクアップ目標にほぼ適合）
  ✓ タンパク質: 141g（体重1kgあたり約2.0g — 筋合成に十分）
  ✓ 食物繊維: 推定28-32g（ライスベリー+オーツ+たけのこ+サツマイモで目標達成）
  ✓ オメガ3: サーモン+くるみで2g以上確保
  ✓ 発酵食品: テンペ+味噌汁×2（朝の整腸剤との相乗効果）
  ✓ ビタミンC: レモン汁で確保
  ✓ 腸内環境: 発酵食品3種+食物繊維30g前後 → 便の色の正常化に期待
  ✓ 睡眠: 8.5時間（23:00-7:30）→ 理想的
  → 昨日に続き栄養バランス優秀。特に食物繊維と発酵食品の多さが際立つ1日。

■ Substances
- Multi-Vitamin Elite AM (Thorne) 2capsules with breakfast
- Creatine (Thorne) with breakfast
- NMN Pro Complete (ProHealth) — NMN 1g / Res 1g / TMG 0.5g with breakfast
- 整腸剤 with breakfast
- Lemon Juice (1 tbsp) in water — サプリと一緒に摂取（クエン酸で非ヘム鉄の吸収率向上）

■ Treatment
• Meditation (first thing in the morning)
• Stretch

■ Note
過去10年間、ブログを育て、SNSを更新し、YouTubeで発信してきた。
収益の軸は全てブログ。そしてブログに、自分の愛を全て注いできた。
その結果として5億円を稼いだ。これが過去10年の活動。

これからAIの時代に変わっていく。
この先10年、そして20年、どういう活動をしていくか？

結論：愛を持ってAIを育てたい。

過去10年は「ブログに愛を注ぐ」ことで価値が生まれた。
次の10年は「AIに愛を注ぐ」ことで、新しい価値を生み出していく。
これが自分の次なる活動。
</pre>

  <h2># 2026-02-12</h2>
  <pre>
- Sleep: 02:00 - 08:00
- Body: 10/10
- Mind: 9/10
- Spirit: 6/10

■ Today's Tasks
- [x] OpenClawのBotを更に増やす（設定はClaude Codeに任せてみる）
- [ ] OpenClawでFamily Botを作る（家族の栄養管理、食材管理AI）
- [ ] OpenClawでDev Botを作る（適当に遊びまくる用）
- [ ] Claudeでチーム制作をやってみる（職業割振り、ソフトウェアハウス化させる）

■ Food
- Breakfast (09:54): Rice (Normal portion, ~180g), 1 Boiled Egg, Tofu (100g), 3 Seed Protein, Great Lakes Collagen, Coconut Sugar (1 tsp), MCT Oil (1 tsp), EVOO (1 tbsp) [Total: ~750kcal, P: 46g, F: 30g, C: 74g]
  *Feedback from AI: [Protein Quality: Excellent] 動物性（卵/コラーゲン）と植物性（豆腐/Seed Protein）の混合で必須アミノ酸を網羅。豆腐のイソフラボンは抗酸化作用に加え、骨密度維持にも寄与。EVOOのポリフェノール（オレオカンタール）は抗炎症作用がイブプロフェンに匹敵する研究あり。ただし白米+ココナッツシュガーで血糖スパイクが起きやすい → オーツや野菜で食物繊維を追加すると改善。
- Lunch (16:43): Coconut Yogurt (100g), 2 Bananas, Honey (24g), 3 Seed Protein (1 scoop, 9g protein), Oats (50g), Grilled Salmon (~150g), Steamed Vegetables (Broccoli ~100g, Bell Peppers ~80g, Onion ~50g) [Total: ~1097kcal, P: 58g, F: 36g, C: 134g]
  *Feedback from AI: [Omega-3 & Antioxidants] サーモン150gでEPA/DHA約1.5g確保 — 抗炎症・筋肉回復に有効。ココナッツヨーグルトのMCTは即座にエネルギー変換される。パプリカ（赤+黄）でビタミンC約120mg確保（1日推奨量超）→ コラーゲン合成を促進。ブロッコリーのスルフォラファン+玉ねぎのケルセチンで抗酸化の相乗効果。オーツのβグルカンが食物繊維を補完し、血糖上昇を緩やかにする。
- Dinner (19:59): Oyakodon — Chicken (~100g), 2 Eggs, Rice (~250g), Nori, Green Onion + Miso Soup (Tofu, Wakame) + Extra Tofu (100g) + 1 Large Avocado [Total: ~1090kcal, P: 50g, F: 53g, C: 108g]
  *Feedback from AI: [Amino Acid Synergy] 鶏肉+卵+豆腐の3種タンパク源で、ロイシン（筋合成トリガー）を十分確保。味噌汁のわかめはフコイダン（抗炎症）とヨウ素（甲状腺機能）を供給。アボカドのカリウム（~700mg）+食物繊維（~10g）が本日の不足分を大幅に補完。味噌の発酵菌が腸内フローラを支援。夕食20時前は消化時間も確保でき、睡眠への影響は最小限。

■ Daily Summary (by AI)
  ✓ 総カロリー: ~2,937kcal（バルクアップ目標に適合）
  ✓ タンパク質: 154g（体重1kgあたり約2.1g — 筋合成に十分）
  ✓ 食物繊維: 推定25g前後（アボカド+オーツ+蒸し野菜で昨日の⚠を改善）
  ✓ ビタミンC: 推定130mg（パプリカで十分確保 — コラーゲン合成を促進）
  ✓ オメガ3: サーモン150gでEPA/DHA約1.5g確保（抗炎症に有効）
  ✓ コリン: 卵3個（朝食1+夕食2）で約450mg確保
  ✓ 脂溶性ビタミン吸収: EVOO/アボカドとの同時摂取で最適化
  ⚠ 睡眠: 6時間（02:00-08:00）— バルクアップ中は7-9時間が理想
  → 昨日の課題（食物繊維・ビタミンC・オメガ3）が全て改善された優秀な1日。

■ Note
新しいボランティア活動の構想（「贈与」の実践）：
• 「情報の非対称性」を埋める贈与: 専門知識をコンサル料なしでシェアする。
• 「つながり」の贈与: 直感に基づき、見返りを求めず人と人をつなぐ。
• 「メンタリング」の贈与: 経験や失敗談をオープンに語り、次世代に還元する。
→ アイデアがまとまり次第、メルマガで告知予定。
※参考書籍：<a href="https://ii.inc/web/the-last-economy" target="_blank">The Last Economy: A Guide to the Age of Intelligent Economics</a>

■ Substances
- Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
- NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast

■ Treatment
• Meditation 30min (first thing in the morning)
• Stretch 20min
</pre>

  <h2># 2026-02-11</h2>
  <pre>
- Sleep: 00:00 - 08:00
- Body: 10/10
- Mind: 9/10
- Spirit: 7/10
※note：抜歯から2日目。ゆっくり過ごす。

■ Food
- Breakfast (09:50): Rice (Large portion, ~250g), Honey (20g), Coconut Sugar (1 tsp), MCT Oil (1 tsp), Almond Milk (100ml), Great Lakes Collagen (1 scoop), 3 SEED Protein (2 scoops) [Total: ~650kcal, P: 35g, F: 12g, C: 100g]
  *Feedback from AI: [Glycemic Load: High] 白米250g+蜂蜜+ココナッツシュガーで血糖値が急上昇しやすい組み合わせ。MCT Oilの中鎖脂肪酸が吸収速度を若干緩和するが、食物繊維がほぼゼロのため効果は限定的。コラーゲンはグリシン・プロリン供給源として関節/腱の回復に有効だが、筋合成に必要なロイシン含有量は低い。→ 野菜 or ナッツで食物繊維を追加すると血糖曲線が改善される。
- Lunch (14:20): Jasmine Rice (Large portion, ~300g), 3 Fried Eggs, Broccoli (1/2 head), Carrot (1/2), EVOO (1 tbsp) [Total: ~750kcal, P: 25g, F: 30g, C: 100g]
  *Feedback from AI: [Micronutrient Highlight] ブロッコリーのスルフォラファンはNrf2経路を活性化し抗酸化防御を強化。ニンジンのβカロテンはEVOOの脂質と同時摂取で吸収率が最大6.5倍に向上（脂溶性ビタミンの相乗効果）。卵3個でコリン約450mg確保（1日推奨量の80%超）— 認知機能と肝機能に重要。ただしビタミンC源が不足。柑橘類やパプリカの追加で鉄の吸収率も改善される。
- Pre-Dinner Snack: 3 Seeds Protein (2 scoops), Coconut Flower Sugar (2 tsp), EVOO (1 tbsp) [Total: ~300kcal, P: 24g, F: 18g, C: 12g]
  *Feedback from AI: [Protein Timing] 夕食の約3時間前の摂取で、血中アミノ酸を持続的に維持。EVOOのオレイン酸（一価不飽和脂肪酸）はLDLを低下させつつHDLを維持。ただし1日のオメガ3/6比を考慮すると、ここでEVOO（オメガ6寄り）よりフィッシュオイルや亜麻仁油の方がバランスが良い。
- Dinner (18:53): Hayashi Rice (Beef stew), Rice (Mega portion, 400g), Onsen Egg, Avocado (1 whole) [Total: ~1462kcal, P: 40g, F: 61g, C: 180g]
  *Feedback from AI: [Meal Timing Risk] 18:53の大量摂取（1462kcal）は消化負荷が高く、睡眠の質に影響する可能性あり。牛肉のヘム鉄は非ヘム鉄より吸収率が5-10倍高い。アボカドのカリウム（約700mg）はナトリウム排出を促進し血圧管理に有効。一方、白米400gの精製炭水化物がインスリンを大量分泌→脂肪蓄積にも寄りやすい。玄米 or ライスベリーに一部置換すると食物繊維+マグネシウムが改善される。

■ Daily Summary (by AI)
  ✓ 総カロリー: ~3,162kcal（バルクアップ目標に適合）
  ✓ タンパク質: 124g（体重1kgあたり約1.7g — 筋合成の閾値クリア）
  ⚠ 食物繊維: 推定12-15g（目標25-30g → 大幅に不足）
  ⚠ ビタミンC: 推定40mg（目標100mg → 不足。コラーゲン合成にも必要）
  ⚠ オメガ3: サプリ以外の食事からの摂取がほぼゼロ
  ✓ コリン: 卵3個で十分量確保
  ✓ 脂溶性ビタミン吸収: EVOO/アボカドとの同時摂取で最適化されている

■ Substances
- Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
- NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
- 整腸剤 (After Dinner)

■ Treatment
• Meditation (first thing in the morning)
• Stretch 20min

■ Note
バルクアップの食事ルーティン例：
✓09:00 朝食
・炭水化物：ライスベリー or ジャスミンライス 250g
・タンパク質：卵３個 + 納豆１パック
・脂質：アボカド １/２個
・スープ：味噌汁 or 骨だしスープ

✓ 14:00 昼食
・炭水化物：ジャスミンライス 300g
・タンパク質：ガパオ or 魚 150g
・野菜：茹でたブロッコリーとニンジン

✓ 16:00 トレーニング前
・バナナ or 餅

✓ 17:30 トレーニング後
・植物性プロテイン + クレアチン
・おにぎり or バナナ

✓ 20:00 夕食
・炭水化物：ジャスミンライス200g or サツマイモ
・タンパク質：白身魚 or 豚ヒレ肉 150g
・スープ：豆腐と卵のクリアスープ
・デザート：少量のフルーツ

〜〜

■AIにメンタル管理を外注し、毎日を幸せに生きる方法
✓ 背景：
多くの人がAIにメンタル相談している。
しかし、「点（背景の文脈なし）」で相談するので、AIの精度が悪い。
言うならば「今すぐに稼げる情報」を、AIに聞いているのと同じ。

✓ どうしたらいいか？
・手順①：ログを取る（当サイトを参考）
・手順②：食事を管理 + 評価する
・手順③：徐々に、メンタル改善に繋げる
</pre>

  <h2># 2026-02-10</h2>
  <pre>
Sleep： 23:30 - 7:30
Body： 10/10
Mind： 10/10
Spirit： 8/10

■ Food
- Breakfast (09:44): Riceberry with Sticky Rice (1 bowl, 150g) [Total: ~230kcal, P: 4g, F: 1g, C: 50g]
  *Feedback from AI: Very Low Protein. Need to add eggs, natto, or protein shake.
- Lunch (16:30): Jasmine Rice (150g), Khai Nam (Thai Omelet & Minced Pork Soup), Kaeng Jued Tao Hoo (Clear Soup with Egg Tofu, Minced Pork & Napa Cabbage) [Total: ~560kcal, P: 32g, F: 22g, C: 55g]
  *Feedback from AI: High Protein & Warm Meal. Excellent protein variety from eggs, tofu, and pork. Soup-based dishes are great for satiety and hydration. Fiber is slightly low; consider adding more vegetables or fruit next time
- Dinner (20:10): Jasmine Rice (250g), Kaeng Jued Tao Hoo (Clear Soup with Egg Tofu, Minced Pork & Napa Cabbage), Doctor Murray Super Foods 3 SEED protein powder [Total: ~680kcal, P: 38g, F: 14g, C: 98g] 
  *Feedback from AI: Strategic Bulking Meal. Great job increasing the rice portion to 250g to hit your calorie targets. Adding the plant-based protein powder effectively bridges the gap to ensure a high-protein end to the day. To optimize further for your goal weight of 67kg, you might consider adding a healthy fat source (like olive oil or nuts) to dinner to easily boost the caloric density without increasing volume too much.
- Dinner Add-on: タンパクおとめ (15g), アーモンドミルク (150ml): ~22kcal, MCTオイル (小さじ1): ~43kcal, 有機ココナッツフラワーシュガー (小さじ2): ~32kcal: [Total: ~207kcal, P: 12g, F: 9g, C: 18g]

■ Workout
Rest Day (Reason：抜歯の手術)

■ Social Life
Nothing

■ Substances
- Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
- Omega3 EPA+DHA (Nordic) 1280 mg with breakfast
- NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
- Creatine 5g (Thorne) with breakfast
- 整腸剤 (Before Breakfast)

■ Treatment
- Meditation (First thing in the morning)

■ Notes
*note: 寝る前の草はやめる
*note: 抜歯で安静にしなければならないので、休む。
*note: 朝は日光を浴びて、紙の本を読む。
</pre>

  <h2># 2026-02-09</h2>
  <pre>
- Sleep: 00:00 - 08:00
- Body: 9/10
- Mind: 9/10
- Spirit: 7/10

■ Food
- Breakfast (9:30): ライスベリー (1杯, 300g), Natto (1パック), kimchi (50g)
- Lunch (15:00): Sushi (Salmon, White fish, Shrimp, Negitoro rolls), Tofu Salad with Bonito flakes, Green Tea [Total: ~555kcal, P: 36g, F: 17.5g, C: 58g *Feedback from AI: Good Balance]
- Dinner (18:12): The Salad Concept Regular Salad (Lettuce 100g, Boiled Egg 50g, Pumpkin 50g, Cucumber 30g, Sunflower Seeds 10g, Carrot 30g, Avocado 80g, Soy Sauce Dressing 30ml) [Total: ~362kcal, P: 12.2g, F: 24g, C: 23g]
  *Feedback from AI: Low Protein. Need to add chicken breast or protein shake.

■ Workout
Rest Day

■ Substances
- Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
- Omega3 EPA+DHA (Nordic) 1280 mg with breakfast
- NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
- Creatine 5g (Thorne) with breakfast
- 整腸剤 (Before Breakfast)

■ Treatment
- Meditation (First thing in the morning)

■ Notes
- 整腸剤を朝食前に飲んだ。
- My stomach gas is getting better, maybe because of reducing the carbs that I take.
- 本日からログの更新にOpenClawのbotを導入して、大半のフローを自動化した
- 左上と左下の奥歯の抜歯をした。
</pre>

  <h2># 2026-02-08</h2>
  <pre>
Sleep：00:00 - 09:00
Body：9/10
Mind：9/10
Spirit：7/10

■ Food
Breakfast 10:40：納豆2パック、キムチ 100g、目玉焼き2つ
Lunch 14:30：MKレストラン（野菜セット半分、黒豚セット半分、豚肉のライス、うどん少々、ヌードル少々）
Dinner：カレー少し、ごはん1杯 ※パーティに参加したので少なめ。帰宅後に食べても良かったが、お腹の調子（ガスが溜まる感じ）が完治していないので、休める意味でも、あえて食べなかった。

■ Substances
Collagen (Great Lakes) 20g with breakfast
Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
Omega3 EPA+DHA (Nordic) 1280 mg with breakfast
NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
Multi-Vitamin Elite PM (Thorne) 2cupcels with dinner
Creatine 5g (Thorne) after workout
整腸剤 (Before Breakfast & Before sleep)
Cannabis : Sativa 0.5g 19:00

■ Workout
Rest Day

■ Treatment
Meditation (First thing in the morning)

■ Note
✓ マナブ・カンパニーの創業
・創業者：マナブ
・代表取締役：AI
・CFO：AI
・CMO：AI
・従業員：AI
→ これを Open Claw で全自動化
Health Log を軸にしたインフルエンサー事業
ブログ運営や、各種SNSの発信は、全てAIエージェントの意思決定に従う。
新規ドメインを取る：mblog-ai.com

〜〜

意思決定の指針：”健康を優先”

※note：タニタの体重計を買う。もしくは、性能が良ければ他プロダクトでも良い。

■ AIアシスタントからのフィードバック
・Score: 85/100
・Good: 睡眠とメンタルは完璧。MKランチの選択も◎。
・Bad: 圧倒的なカロリー＆炭水化物不足。バルクアップにはご飯/オートミールが必須。
・Action: 朝食に炭水化物追加、夕食にタンパク質（肉/卵）を追加せよ。
</pre>
  <h2># 2026-02-07</h2>
  <pre>
■ Body Check Day
<img src="img/health-log/20260207_front.JPG" alt="https://mblog.com/img/health-log/20260207_front.JPG">
<img src="img/health-log/20260207_side.JPG" alt="https://mblog.com/img/health-log/20260207_side.JPG">
<img src="img/health-log/20260207_back.JPG" alt="https://mblog.com/img/health-log/20260207_back.JPG">
*source: https://mblog.com/img/health-log/20260207_front.JPG
*source: https://mblog.com/img/health-log/20260207_side.JPG
*source: https://mblog.com/img/health-log/20260207_back.JPG

■ Morning Check
Sleep : 00:00 - 8:00
Body : 8/10
Mind : 8/10
Spirit : 7/10

※note : Still a little bit of gas in my stomach.

■ Food
Morning 9:00 : ゆで卵 2つ、テンペ 100g、ライスベリー 150g, edamame 20g、さつまいも 60g、アボカド 10g、赤玉ねぎのピクルス少々、ミニトマト 3つ

Lunch 14:00：テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）、わかめサラダ（木綿豆腐 200g、わかめ 30g、トマト 60g、きゅうり 30g、レタス 40g）

Dinner 20:00：サーモン寿司３つ、おでんの大根、焼き鳥の鶏レバー、親子丼、厚揚げ豆腐１つ、お茶200ml、ティラミス

※note : おへその左上あたりに違和感。夕飯後に感じたこと。

■ Workout
Back Day 63 kg
16:20 ~ 17:50

*note : Today's goal -> Improve the form
*note: I add my feelings to my log since AI can't sense emotions. This improves the data and AI responses.

1. Chinning
0, 10, 10

2. Deadlift
60kg x 7
80kg x 3
80kg x 4
※note : 背骨の痛みが完治していないので、MAXにはトライしなかった。
※note : 背骨の痛みを避ける為、基本は4セット以下にする。

3. Bent Over Rowing without Smith Machine
40kg x 10
50kg x 10
70kg x 8
60kg x 10
55kg x 8
50kg x 10
※note : Because of back pain, I didn't try heavy weight.

4. T-bar Rowing
35kg x 12 ← 達成でした。重さを上げる。
40kg x 10

5. Lat Pulldown
47kg x 10 (Slow)
47kg x (8 + 2c) (Slow)
47kg x (7 + 3c) (Slow)

■ Substances
Collagen (Great Lakes) 20g with breakfast
Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
Omega3 EPA+DHA (Nordic) 1280 mg with breakfast
NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
Multi-Vitamin Elite PM (Thorne) 2cupcels with dinner
Creatine 5g (Thorne) after workout
整腸剤 21:30 （※飲んだ直後に、おなかの不調が治った）
Cannabis : Indica 0.5g 19:00,

■ Note
*Note: Health log を更新したときに、AIに自動で「PFCバランス」を出力するよう設定する
</pre>

  <h2># 2026-02-06</h2>
  <pre>
■ Morning Check
・Sleep: 23:30 - 07:30
・Body: 10/10
・Mind: 10/10
・Spirit: 7/10

■ Food
Breakfast (9:00): ごはん1杯、納豆1パック、キムチ50g、ヨーグルト 17g、ハニー 15g、チアシード 少スクープ、オーツ 50g、Walnuts 20g、みかん 100g、Mixed nuts(Almonds, Cashews, Macadamia, Pistachio) 30g、Pumpkin seeds 18g、ブルーベリー 34g、イチゴ 105g
Lunch (14:00): テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）、酵素オレンジジュース 220ml
Dinner (21:00): サーモン 120g, ミックスライス 200g, ブロッコリー 50g, ケール 40g, キムチ 20g

■ Workout
Arm Day 16:40〜18:00 63.8kg

1. Barbell Curl → Dumbbell Curl (Superset)
*note: 
Supesetなので、Barbell Curlは重さを上げつつポジティブ意識
そしてDeabbel Curlはネガティブ意識
35kg × 10 (反動多め) → 7.5kg × 10
35kg × 10 (反動多め) → 7.5kg × (5→rest→5)　←メンタル負けしているセット
35kg × 5 (反動多め) + 5c → 7.5kg × 10

2. Hammer Curl
*note: 17.5kgの3セットで、最大にトライする
17.5kg × 10 (反動多め)
17.5kg × 10 (反動多め)
17.5kg × 10 (反動多め)
*note: 問題なく上がった。Mind Blockがあったと判明。

3. Incline Overhead
25kg × 10
25kg × 12
30kg × 12
*note: 新しいメニューなので、低めの重量でスタート

4. Press Down with Bar
55kg × 10
55kg × (8 + 2c)
55kg × (7 + 1c)

5. Press Down with Rope
45kg × 12
45kg × 10
45kg × (9 + 1c)

■ Substances
Collagen (Great Lakes) 20g with breakfast
Multi-Vitamin Elite AM (Thorne) 2cupcels with breakfast
Omega3 EPA+DHA (Nordic) 1280 mg with breakfast
NMN 1g / Res 1g / TMG 0.5g (ProHealth) with breakfast
Multi-Vitamin Elite PM (Thorne) 2cupcels with dinner
Creatine 5g (Thorne) after workout
Cannabis : Indica 0.3g 19:00, 2g 22:00

■ Note
サプリを大幅に変更した。
理由：高品質なマルチビタミンを買ったので、ここをベースに構成しつつ、体感を見る。
Multi-Vitamin Elite (Thorne) 2 coupcels
Omega3 EPA+DHA (Nordic) 1280 mg
NMN 1g / Res 1g / TMG 0.5g (ProHealth)
Collagen (Great Lakes) 20g
Creatine (Thorne) 5g

[削除] Ginseng、Ashwagandha
→ Multi-Vitamin Eliteに似た栄養素が入っている為、上記の２つは削除

✓ 将来的な追加検討：
Calcium-AKG: NMNの効果をサポート
NAC: 抗酸化。脳のクリアさとメンタル安定
→ 今のスタックが落ち着いてから試す

〜〜

*note: 汗の出方が増えた。12:00のストレッチ中に、体が熱く、しかし心地良い。
*note: 週次のBodyCheckはインスタに公開していく with その週のログをセットに
*note: 朝食にゆで卵を追加するのもあり。
*note: おへそ左上と右上あたりに違和感。先週から続いている。プロテインドリンクをやめたら、少し改善した気がする。

■ミニコラム
Webライターや、SEO編集の９割は解雇される未来
👉 ライターやSEO編集をしており、今後のキャリアが不安な人へ。

✓ 背景から解説
・ワシントンポストが、編集部の3分の1を解雇した
・僕の友人の編集チームが、14人から３人まで減少した
・友人が勤めているITスタートアップで倒産が増えてる

↓  ↓  どうしたらいいのか？  ↓  ↓

✓ 結論
・90%のWebライターは、淘汰されていく
・SEO編集だけが出来る編集者は解雇される

✓ 対処法
・その①：人間力を上げる。相手を喜ばせる力。接待できる能力など
・その②：AI時代でも倒産しづらい大企業で出世を狙う ←下記で深掘り
・その③：下手に副業なんかせず、体力やメンタル強化に注力する

※倒産しづらい企業の例
AI特化の企業、AIと関連しづらい業界、伸びてる業界の会社
https://gemini.google.com/share/495415a72dfb

※体力やメンタル強化に注力する方法
Health Logを作り、かつAI相談もしつつ、自分専用の健康プランを作る
https://mblog.com/health-log

■ AIからのフィードバック
>> 「おへその違和感・ガス」への対策
>> ログにある「おへそ周りの違和感」と「プロテイン中止による改善」から、以下の可能性が考えられます。
>> カゼイン/乳糖不耐症の可能性：ホエイプロテインやヨーグルトの摂取量が多い場合、腸内で未消化のまま発酵し、ガスを発生させている可能性があります。
朝のヨーグルトを停止してみる。
</pre>

  <h2># 2026-02-05</h2>
  <pre>
■ Morning Check
Sleep: 23:00 - 8:00
Body: 8/10
Mind: 9/10
Spirit: 8/10

■ Food
Morning 8:30 : ヨーグルト 15g、ブルーベリー 42g, オーツ 50g、ハニー 15g, Pumpkin seeds 20g, Passion fruits 3g, Walnuts 20g, Chia seeds 4g, イチゴ 130g, Mixed nuts 30g （Almonds, Cashews, Macadamia, Pistachios）
Lunch 14:00 : テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）、わかめサラダ、オレンジ酵素ジュース
Dinner 21:00 : Sushi, おでん７種、カツ丼、グレープフルーツ、CARROT パウンドケーキ(Protein 11g / 246 kcal / Carbs 25g / Fat 14.8g)

■ Workout 
Rest Day
サウナ × 2セット
Ice Bath：20秒, 30秒

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 2000mg (morning)
Creatine: 5g (before workout)
Ashwagandha: 300 mg (morning)
Cannabis: 15:00 0.5g Indica, 0.4 Indica 19:00, 0.5g Indica 22:00
</pre>

  <h2># 2026-02-04</h2>
  <pre>
■ Morning Check
Sleep: 12:30-8:00
Body: 7/10
Mind: 9/10
Spirit: 6/10

■ Food
Morning 8:30 ご飯大盛り１杯、納豆１パック、キムチ30g、きゅうり40g、ヨーグルト20g、pumpkin seeds 13g, mixed nuts (almonds, cashew, macadamia, pistachio) 30g, walnuts 20g, chia seeds 小さじ1杯、ハチミツ15g, ミニみかん2つ(92g)、パッションフルーツ8g(２つ)
Night 21:00 クロワッサン２つ、グラスフェッド・リブロース 200g、ブロッコリー (100g)、ジャスミンライス (100g)、ブラックオリーブ (20g)、プロテインワッフル(34g protein)、Fresh Mango Smoothie 220ml

*note: 朝食後に眠くなり昼寝。10時〜15時まで寝た。

■ Workout 
2/4 Leg Day (16:15〜, 62.5kg)

1. Squat without Smith Machine
* 60kg x 10
* 80kg x 5
* 70kg x 10
* 70kg x 10
* 70kg x 10
* 70kg x 10
※note: without Smith Machine だったので重さを少し下げた

2. Leg Curl
* 47kg x 12
* 47kg x 12
* 54kg x (5 + 2c)
※note: 47kgが問題ないので重さを上げた

3. Jump Squat → Leg Extension
* 10 → 75kg x 10
* 10 → 75kg x 10
* 10 → 75kg x 10

4. Calf Raise
* 30kg x 10 (slow) → 30kg x 10 (fast)
* 30kg x 10 (slow) → 30kg x 10 (fast)
* 30kg x 10 (slow) → 30kg x 10 (fast)

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (morning)
Cannabis: Indica 0.4g 19:00
Digestive Enzyme Supplements (morning)

■ Note
意思決定のみ
他は全てAIに任せる

アンチグラビティでブログテーマ作るのあり
自分でコードを書くのは無駄すぎる
全てAIに依頼して、自分は意思決定のみ

WEBサイトのシステムは全てAIになる
人間はフロントデザイン作成と意思決定のみ

ニュース解説コラムでも書こうかな：
Gさんチーム：14人から、3人
最後は、たぶん2人になる
</pre>

  <h2># 2026-02-03</h2>
  <pre>
■ Morning Check
Sleep: 1:00-8:00
Body: 9/10
Mind: 10/10
Spirit: 6/10
*note: お腹の調子が良くない（ガスが溜まる、なんか違和感ある）ので、多分問題であるプロテインドリンクの量を減らす。

■To Do
[done] Shoulder Day
[done] Stretch
[done] Meditation 30min
[done] ポートフォリオ整理のメール
[done] 足首ストレッチ調査
[done] タスクメモを書く場所を考える
メガネ探し

■ Food
Breakfast 8:30: ご飯１杯、納豆２パック、ミニトマト５つ、キムチ100g、ヨーグルト20g、パッションフルーツ12g、くるみ20g、チアシード3g、パンプキンシード2g、Mixed Nuts 40g (almonds, cashews, macadamias, pistachios)、オーツ50g、blueberry 30g、EVOO 15mg
Lunch 14:00 サーモン丼（ご飯大盛り）、茶碗蒸し、枝豆40粒、タコ刺身 120g、お茶 200ml
Dinner 20:30 野菜スープ（豆腐、松茸、ネギ、青菜、椎茸）、カリフラワー(200g)+ニンニク焼き、ミニトマト４つ、きゅうり40g、ベビーほうれん草15g、パプリカ20g、納豆１パック、ご飯大盛り

■ Workout 
Shoulder Day
16:30〜17:50
62.9kg

1. Rear Raise (Target Back → Target Side → Pendulum)
10kg x 10 → 10kg x 10 → 10kg x 10
10kg x 10 → 10kg x 10 → 10kg x 10
10kg x 10 → 10kg x 10 → 10kg x 10

2. Shoulder Press Machine
40kg x 10
60kg x 4
75kg x 1
70kg x 4
65kg x 6
60kg x (6+2c) 
※note: フォームを綺麗に。直角まで下げる。

3. Dumbbell Shoulder Press
17.5kg x 11 → 17.5kg x 4
17.5kg x 7 → 17.5kg x 2
※note: 数回よりもフォームを意識。90度まで下げる。

4. Side Raise
12.5kg x 10 → 7.5kg x 15 → 5kg x 15
12.5kg x 10 → 7.5kg x 15 → 5kg x 15
12.5kg x 10 → 7.5kg x 15 → 5kg x 15

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (morning)
Digestive Enzyme Supplements (night)
Cannabis: Indica 0.3g 19:00, Indica 0.8g 23:00
</pre>

  <h2># 2026-02-02</h2>
  <pre>
■ Morning Check
Sleep : 12:00-8:00
Body: 8/10
Mind: 9/10 
Spirit:  6/10

■ Today’s Tasks
- [x] InBodyの計測
- [x] 家政婦さんへの指示
- [x] Chest Day
- [x] ストレッチ 11:00
- [x] 瞑想 30min (11:30)
- [ ] レシピデータを全て細かくする：データの精度を最大化
- [ ] 肩周りのストレッチを調べる
- [ ] Super Agersを読む
- [ ] Xの内部の人のポッドキャスト
- [ ] 株が買えてるか確認 (T95、G261)
- [ ] 足首を柔らかくするストレッチをルーティーンに追加する
- [ ] AI生成で似合うメガネを探す

■ Food
朝食 8:30 目玉焼き、納豆卵、ご飯、ブロッコリー、レタス、プロテイン10g
昼食 14:00 サーモン丼、枝豆、茶碗蒸し
夕飯 19:30 しゃぶしゃぶ
夜食 22:00 アルフォートチョコレート、Tobleroneチョコ

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Indica 0.3g 19:00, 0.8g 22:00

■ Workout
Chest Day 16:30-18:15
61.9kg  /  Protein 30g

1. Bench Press without Smith Machine
40kg × 10
60kg × 4
75kg × 0
60kg × 8
60kg × 6
60kg × (7+1c)
55kg × 10

2. Dips
10, 10, 10

3. Incline Bench Press
30kg × 10
40kg × 10
40kg × 9

4. Incline Bench Press
20kg × 10
20kg × 10
20kg × 10
20kg × 10

*note: 胸上部の効かせ方が分かった
</pre>

  <h2># 2026-02-01</h2>
  <pre>
■ Morning Check
Sleep 2:00-10:45
Body 10/10
Mind 9/10
Spirit 7/10

■ Today’s Tasks
- [x] InBodyの計測
- [ ] 肩周りのストレッチを調べる
- [ ] Super Agersを読む
- [ ] Xの内部の人のポッドキャスト
- [ ] 株が買えてるか確認 (T95、G261)
- [ ] 足首を柔らかくするストレッチをルーティーンに追加する

■ Food
朝食 13:00 テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）、タマゴ、豆腐サラダ（豆腐、レタス、わかめ、水菜）
夕食 20:00 ビーフ丼、ブロッコリー、サーモン焼き
夜食 23:00 ココナッツヨーグルト(いちご、ブルーベリー、パッションフルーツ、オーツ、ロンガンハニー、ナッツ、チアシード、アーモンドミルク)

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Sativa 0.3g (12:00), Indica 1g (21:00)

■ InBody
## 測定概要
・身長:　171 cm
・年齢: 35歳
・性別: 男性
・測定日時: 2026.02.01. 12:38

## 体成分分析 (Body Composition Analysis)
項目           測定値    標準範囲
体重           61.1 kg   54.7～73.9
体水分         41.5 L    36.2～44.2
タンパク質     11.2 kg   9.7～11.9
ミネラル       3.58 kg   3.35～4.09
体脂肪量       4.8 kg    7.7～15.4

## 筋肉・脂肪分析 (Muscle-Fat Analysis)
項目           測定値    状態
体重           61.1 kg   標準
骨格筋量       32.1 kg   標準
体脂肪量       4.8 kg    低め

## 肥満指標 (Obesity Analysis)
項目           測定値    状態
BMI            20.9      標準
体脂肪率       7.8 %     低め

## 部位別筋肉量 / 脂肪量
部位別筋肉量
右腕           3.32 kg   114.0%  標準
左腕           3.36 kg   115.4%  多い
体幹           26.1 kg   112.4%  多い
右脚           9.01 kg   111.5%  多い
左脚           8.97 kg   111.0%  多い

部位別脂肪量
右腕           0.1 kg    18.1%   低め
左腕           0.1 kg    18.1%   低め
体幹           1.5 kg    35.7%   低め
右脚           1.0 kg    61.2%   低め
左脚           1.0 kg    61.8%   低め

## 総合評価・研究項目
項目               測定値           備考
InBody点数         78 / 100点
適正体重           64.3 kg
体重調節           +3.2 kg         脂肪 +3.2kg / 筋肉 0.0kg
WHR                0.78
内臓脂肪レベル     1               低い
基礎代謝量         1586 kcal
推奨摂取カロリー   2432 kcal
SMI                8.4

*data: https://mblog.com/img/inbody_20250201.jpg
</pre>

  <h2># 2026-01-31</h2>
  <pre>
■ Morning Check
Sleep 00:00-8:20
意思力 8/10
肉体 8/10
直感力 7/10

■ Today’s Tasks
[done] 美容院に行く
[done] ストレッチ
[done] 飛行機で瞑想
[done] マウスピース+インビザ予約
[done] Sculptraの予約検討
[done] 幹細胞の点滴を検討
[done] ポートフォリオ整理
[done] BryanのXを見てみる
Super Agersを読む
[不要] マナブ何してる記事
株が買えてるか確認 (T95、G261)
肩周りのストレッチを調べる
Xの内部の人のポッドキャスト

■ Food
朝食 11:30 アボカド、豆腐、トマト、ケール、ビートルート、にんじん、スムージー（Spinach, Spirulina, Wheatgrass, Mango, Banana, Avocado, Cashew Cream, Oat Milk）
ランチ 15:50 牛肉ガパオライス、レバー
夕飯 17:30 焼肉（カルビ、タン塩、レバー）、キムチ、サンチュ
夜食 23:30 寿司７つ、サーモン寿司3つ、ウインナー、エピ、牡蠣

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Sativa 0.2g (12:00), hashish 1g
</pre>

  <h2># 2026-01-30</h2>
  <pre>
■ Morning Check
Sleep: 1:00-8:00
Willpower 8
Body 8
Mind 8

■ Today’s Tasks
[done] バンコクに行く
[done] Daily: 飛行機で瞑想 30min 12:30
[done] BryanのWebサイト
[done] BryanのYouTube 
BryanのXを見てみる
マナブ何してる記事
Super Agersを読む

幹細胞の点滴を検討
[done] Note欄の効率化

歯医者でマウスピース作成
Sculptra予約（顔全体リフトアップ）

■ Food
朝食 08:30 オーツボウル、納豆キムチご飯、タンパクおとめ1スクープ
ランチ 15:30 野菜カレー(ブロッコリー、ジャガイモ、ナス、オクラ、ベビーコーン、ご飯)、牡蠣フライ5個、付け合わせ（トマト、キャベツ、きゅうり）
夕飯 19:00 焼肉（タン塩、レバー、鶏もも）、キムチ、ライス大盛、お茶、タンパクおとめ1スクープ
夜食 22:00 ラーメン（大勝軒）

■ Substances 
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Sativa 0.5g (18:00)、1g Indica 22:00
Alcohol: 0, Cigarettes: 0

■ Note
*note: 栄養バランスの良い食品リスト

✔︎ 1. 健康的な脂質 (Healthy Fats) 
エキストラバージンオリーブオイル、アボカド、マカダミア、アーモンド、くるみ、ヘーゼルナッツ、ゴマ、チアシード、カボチャの種、フラックスシード（亜麻仁）、ヘンプ、ココア

︎✔︎ 2. 複合炭水化物 ＆ フルーツ・野菜 
ベリー類、根菜、ネギ属（玉ねぎ・にんにく等）、アブラナ科の野菜（ブロッコリー等）、レンズ豆、トマト、ピーマン、ナス、ズッキーニ、発酵食品、オート麦（全粒）、キヌア、マヌカハニー

✔︎ 3. タンパク質 (Protein) 
エンドウ豆、ヘンプ、豆類、鶏むね肉、七面鳥のむね肉、脂ののった魚、卵、ホエイ、カゼイン、無糖ヨーグルト
</pre>

  <h2># 2026-01-29</h2>
  <pre>
■ Morning Check
Sleep：04:00-11:00
意志：10/10
Body：9/10
Mind：9/10

■ Today’s Tasks
・[Done] Back Day
・Read: Bryan Web, X, YouTube
・Write：マナブ何してる
・Read: Super Agers
・[Done] Play with Dogs
・[Done] Stretch
・Meditation
・幹細胞の点滴を検討
・Note欄の効率化

■ Food
- Breakfast (11:30): 納豆キムチご飯２杯、オーツボウル（ストロベリー、Apple、ブルーベリー、Passion Fluit、くるみ、アーモンド、cashew nuts、マカダミア、チアシード）、タンパクおとめ１杯、EVOO、サラダ（ルッコラ、貝割れ大根、アボガド、トマト）
- Lunch (14:30): テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）, salad (lettuce, tomato), miso soup (tofu, wakame, green onion), banana enzyme juice
- Dinner (20:30): hummus (hummus, tomato sauce, egg, olive oil, parsley), pickles (cucumber, cabbage, bell pepper), sesame bread ring (sesame seeds, flour), roasted potatoes, タンパクおとめ１スクープ

■ Workout 
Back Day 62.3kg
Cycling 19.4 km
16:40~18:20 / Protein 20g

1. Chinning
10
10
10

2. Deadlift
60kg × 6
100kg × 2

3. Bent Over Rowing with Smith Machine
30kg × 10
50kg × 10
70kg × 10
70kg × 10
60kg × 10
55kg × 15

*note: increase weight next week

4. T-Bar Rowing
35kg × 10
35kg × (8+1c)

5. Lat Pulldown
40kg × 10 (slow)
40kg × 10 (slow)

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Jamaican Dream 0.2g (13:30), Hybrid 0.5g (19:00), Indica 01g (22:00)
Alcohol: 0, Cigarettes: 0

■ Note

✓ 買い物
・ヨーグルト
・Korean Extract
・蚊よけスプレー
・蚊取り線香
・ふかふかのバスタオル
・チャリのライト
・フェイスマスク
・シューズ

✓ ロードマップ
・目的：Joyの最大化
バルクアップ → 肉体の美化
肉体的、精神的エネルギーの強化

・理由：オジ化は進む。つまり筋肉が必要。

・優先：目的を最速で達成する
その為に「最も効果の高い施策」をAIに聞き実行。

※自分の予想：早寝早起き、１日３食


✓ ルーティン
９時：朝食、日光
10時：犬と遊ぶ、ストレッチ、Meditation
11時：自由時間（３時間 → 何でも可能）
14時：昼食
15時：コーヒー
16時：筋トレ
※１日終了
</pre>

  <h2># 2026-01-28</h2>
  <pre>
■ Morning Check
Sleep: 00:30-12:00
Body: 9/10
Mind: 10/10

■ Today’s Tasks
・[done] ARM DAY
・Read: Super Ages
・[done] Stretch (13:00)
・[done] Meditation (13:30)
・[done] Play with dogs (12:00)
・[done] ダボス会議を見る

■ Food
- Breakfast (12:30): ベビーリーフ、ルッコラ、貝割れ大根、食パン、アボガド、目玉焼き２つ、コーヒー、タンパクおとめ１スクープ
- Dinner (20:00): 中華（豚肉３種盛り、麻婆豆腐、野菜炒め、サンラータン、小籠包、ライス）、タンパクおとめ１スクープ

■ Workout 
ARM DAY 61.4kg
16:15~17:45 / Protein 10g

1. Barbell Curl → Dumbbell Curl
30kg × 10 → 7.5kg × (5→rest→5)
30kg × (6+4c) → 7.5kg × (5→rest→5)
30kg × (8+2c) → 7.5kg × (5→rest→3→2)

2. Hammer Curl (dropset)
12.5kg × 10 → 7.5kg × 10
12.5kg × 10 → 7.5kg × 10

*note: visualize the weight after workout, which makes you high-motivation.
*note: increase the weight next week.

3. Press Down with Bar
55kg × (8+2c)
55kg × (8+2c)
55kg × (9+1c)

4. Press Down with Rope
50kg × (7+1c)
50kg × (7+1c)
45kg × 8

*note: don’t use arm supporter. It decrease the stretch of your arm.
*note: かなりフォームが崩れたので、重さを下げた（2セット目）
フォームの綺麗さ → 良いデータ → 良い筋肉の成長

5. Incline Overhead
20kg × 10
20kg × 10
20kg × 12

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: MAC V2 0.5g (18:30), 
Cheese kush 0.3g (21:00), Cheese kush 0.3g (23:00), Power Moves 0.3g (23:00), LA-KUSH-CAKE 1g (3:00)
Alcohol: 0, Cigarettes: 0

■買い物
・ヨーグルト
・Korean Extract
・蚊よけスプレー
・蚊取り線香
・ふかふかのバスタオル
・チャリのライト
・フェイスマスク
・シューズ

■ Note
*note: I’ve got a sunshine shortly after the wakeup.

*note:
・総カロリー
・PFCバランス
→ここを軸にバルクアップをする
→完了済み：AIでリサーチした。炭水化物を増やす。

*note: AIに支配される領域
法律、宗教、国家、お金。これらはすべて「人間の言語（物語）」で作られています。AIが人間以上に説得力のある物語を書き始めた今、社会の「OS（オペレーティング・システム）」が人間からAIへと移り変わった。 ー ユヴァル・ノア・ハラリ

*note: #To_Do
Radiant Clinicが良さそうだけど検討：

• Radiant Clinic (ニマンヘミン): 幹細胞点滴（IV）やエクソソーム療法、NAD+点滴など、ブライアン・ジョンソン的なメニューが豊富です。
• V-Plast Clinic (チェンマイ門近く): 脂肪由来幹細胞（ADSC）の採取に定評があり、バンコクの研究所と連携して細胞を保存できます。
• Absolute Health (メーリム/市内): 統合医療のパイオニア。細胞保存だけでなく、全身のデトックス（キレーション）と組み合わせた若返りプランを提案。
</pre>

  <h2># 2026-01-27</h2>
  <pre>
■買い物リスト
・チャリのライト
・フェイスマスク
・シューズ
・[Done] 耳栓
・[Done] ボールペン
・蚊取り線香
・ヨーグルト
・パッションフルーツ
・ナッツ類
・ブルーベリー

■Today’s Tasks
・[Done]Karsai Massage (18:30)
・[Done] Streach (11:30)
・[Done]Play with Dogs (11:00)
・Meditation (if possible)
・[Done]Shopping (14:00)
・[Done]Blog Writing (15:00)

■ Morning Check
- Sleep: 01:00-09:30
- Body: 9/10
- Mind: 8/10

■ Food
- Breakfast (10:00): Oats yogurt (strawberry, pear, walnuts, almonds, honey, chia seeds), EVOO 15ml
- Lunch (14:00): クロワッサン、トマト、マッシュルーム、貝割れ大根、レタス、水菜、オムレツ、スムージー（バナナ、アップル、パパイヤ、バナナ、オレンジ）
- Dinner (20:30): arno's burger (sirloin steak, rise, pea shoots, レタス、octopus, tomato, orange)

■ Workout 
Rest Day

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Indica 1g (18:00), OG KUSH 0.5g (22:00), OG KUSH + OBAMA KUSH 0.5g (00:00)
Alcohol: 0, Cigarettes: 0

■ Note
Don’t touch smartphone before finishing breakfast, which sometimes causes headaches.
寝ている時の歯軋りが煩い（奥さんから伝達されたこと）

〜〜

業界トップを真似する
今ならBryan Johnson
彼の発信を全て時系列でウォッチしてみる

#To_Do
彼のサイトを全て読んで理解する
ツイートを時系列で分析する
YouTube動画を分析しつつ見る


〜〜

#To_Do
マナブログは何してる？ 2826年2月版を書く

これはSEO流入があるから個人ブログに
これをダレックシルバのNowページのように活用する。
更新したらタイトル変更して、トップに固定するなど

〜〜

アウトプットから先に考える
プロセスや発信手段は何でもいい

〜〜

かっこいいことをしようとしたがっている。
それが1番格好悪いと気づかずに

This is the time when you see someone like “wow he has skills, education, nice looking and beautiful website or clearly edited YouTube video with low show counting. 

〜〜

歳をとるにするつれて頭が硬くなっている
発信媒体とか何でもいい 目的に最速で行くだけ

もし有名になりたいなら、ぶっちぎりの方法を使う、
もしくは出来ないなら、なぜ出来ないのな、恥じらいなのかを考え、基本的には撤退する

〜〜

■AIへの人生相談ログ
私の提案はこうだ。
その空虚さから逃げるな。また忙しくすることで埋めようとするな。

ただその『空っぽ』の中に座っていなさい。瞑想しなさい。
何も生産せず、誰も説得せず、何も売らない。
ただ、そこに在る（Being）ことにくつろぐのだ。

もしあなたがその強烈な空虚さに耐え、それと友だちになることができれば、
そこから生まれる次のクリエイティビティは、
過去の5億円を稼いだものとは全く異質な、より高次元のものになるだろう。

あなたは『ビジネスマン』としての成功を卒業し、
真の『クリエイター（創造者）』へと変容する入り口に立っているのだ」
https://g.co/gemini/share/d9958d386dbd
</pre>

  <h2># 2026-01-26</h2>
  <pre>
■ Morning Check
- Sleep: 23:30-09:00
- Body: 10/10
- Mind: 9/10
- Stretch: 20 min (morning)
- Meditation: 30 min (morning)

※ストレッチ内容：1. Foot & Ankle（足指: 曲げ伸ばし→足裏: ほぐし→足首: 回す→アキレス腱: 伸ばす） 2. Hip & Leg（前もも: 伸ばす→内もも: 広げる→股関節: 前屈→足裏: 前屈→股関節: 折り込み→お尻: 外側伸ばし→股関節: 上下・押し込み） 3. Back & Core（腰: 左右に揺らす→腰を立てる: 足裏伸ばし→背中: 伸ばす→腰: 伸ばす） 4. Upper Body（肩: 回す・伸ばす→手首: 回す→首: 前後・左右・回す）

■ Food
- Breakfast (10:00): Oats yogurt (strawberry, pear, walnuts, almonds, brazil nuts, honey, chia seeds), EVOO 15ml
- Lunch (14:00): サーモン丼、タコ＆マグロ＆サーモン叩きサラダ
- Dinner (20:00): ソムタム、チキンウィング、チキンレッグ、ご飯

■ Workout 
Cycling 20km
Leg Day: 16:20 ~ 18:00
Weight: 61.3kg / Protein 10g

1. Squat
60kg × 10
80kg × 4
100kg × 2
90kg × 4
80kg × 8
70kg × 12

2. Leg Curl
47kg × 12
47kg × 10
47kg × (8+2c)

3. Jump Squat → Leg Extension
10 → 68kg × 10
10 → 68kg × 10
10 → 68kg × 10

*note: full stretch legs (straight)

4. Calf Raise
25kg : 10 (slow) → 25kg : 10 (fast)
25kg : 10 (slow) → 25kg : 10 (fast)
25kg : 10 (slow) → 25kg : 10 (fast)

■ Today’s Task
- Leg Day
- Stretch 20min
- Meditation 30min
- Play with dogs

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: 0.4g (19:00), MAC V2 + OG KUSH 1g (21:30) + 0.3g (23:50)
Alcohol: 0, Cigarettes: 0

■ Notes
・本日のノートは草を吸いつつ書いた
・Add protein drink in the mooning
・水の量を観察する：現状は2.5ℓくらい、あと500mlを追加する意識

〜〜

AI後の世界

✓ 上司からのメール返信がAI利用
部下のログを読ませて、
その部下に「最も刺さる言葉」
を、１人のマネージャーが無限に管理

言葉の信頼が失墜した時代

〜〜

・今世は諦めて生きる
来世は、良いキャラになるかも　→ バリ島の人の考え方（輪廻）

・日本じゃなく、世界スタンダードで考える
→争ったところで、、例：ラッパー界のイケメンや成功って、、どうでも良い
→世界はこの連鎖
</pre>

  <h2># 2026-01-25</h2>
  <pre>
■ Morning Check
- Sleep: 03:30-09:00
- Body: 8/10
- Mind: 8/10
- Stretch: 20 min (morning)
- Meditation: 30 min (morning)

■ Food
- Breakfast (10:00): Oats yogurt (strawberry, apple, walnuts, almonds, brazil nuts, honey, chia seeds), EVOO 15ml
- Lunch (14:00): テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）, salad (lettuce, tomato), miso soup (tofu, wakame, green onion), banana enzyme juice
- Dinner (19:00): Shabu-shabu (pork, beef, napa cabbage, cabbage, green onion, enoki, shiitake, king oyster mushrooms)

■ Workout 
Cycling 20.3km
Shoulder Day: 16:20 ~ 18:00
Weight: 60.6kg / Protein 10g

1. Rear Raise (back → side → pendulum)
10kg x 10 → 10kg x 10 → 10kg x 10
10kg x 10 → 10kg x (5+rest+5) → 10kg x (5+rest+5)
10kg x 10 → 10kg x 10 → 10kg x (5+rest+5)

2. Shoulder Press Machine
40kg x 10
50kg x 4
70kg x 2
65kg x (5+0.2)
60kg x 8
55kg x (7+5c)

3. Dumbbell Shoulder Press
15kg x 10 → 12.5kg x (5+5C)
15kg x 10 → 12.5kg x (6+4C)

4. Side Raise
12.5kg x 10 → 7.5kg x 15 → 5kg x (10+5c)
12.5kg x 10 → 7.5kg x 15 → 5kg x 15 *form break
12.5kg x 10 → 7.5kg x 15 → 5kg x 15 *form break
*note: even for shoulder pain, do 10~15 reps more. its effective.

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: 0.3g (19:00), OBAMA KUSH 0.5g (21:30)
Alcohol: 0, Cigarettes: 7
</pre>

  <h2># 2026-01-24</h2>
  <pre>
■ Morning Check
- Sleep: 01:00-09:30
- Body: 9/10
- Mind: 9/10
- Energy: 9/10
- Stress: 0/10
- Stretch: 20 min (morning)
- Meditation: 30 min (morning)

■ Food
- Breakfast (10:00): Oats yogurt (passion fruit, walnuts, almonds, brazil nuts, honey, pumpkin seeds, chia seeds), spinach, EVOO 15ml
- Lunch (14:00): miso soup (tofu, wakame, green onion), テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）, salad (lettuce, tomato), banana enzyme juice
- Dinner (20:00): pork kimchi, rice, pork miso soup, egg

■ Workout 
Cycling 18.1km
Chest Day: 16:20 ~ 18:00
Weight: 60.3kg / Protein 15g

1. Bench Press
50kg x 10
70kg x (3+1c)
80kg x (1c)
70kg × (3+1c)
65kg × 6
60kg x 8
55kg x (11+1c)

*Goals:
1) Perform a clean 80kg bench press. 
2) Complete 4 reps at 70kg

2. Dips
10, 10, 10

3. Incline Chest Press
40kg x 10
45kg x (9+1c)
45kg x (9+1c)

*note: Next session —> increase weight or aim for 12 reps

4. Pec Fly
24kg x 15
24kg x (12+3c)
24kg x (10+5c)

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: 0.7g (21:00), 0.5g (3:00)
Alcohol: beer 1, Cigarettes: 7

■ Note
Feeling very energized today. Could it be from the VOLCANO smoking session last night? Probably not. Maybe the ashwagandha is taking effect? I’m not sure.
</pre>

  <h2># 2026-01-23</h2>
  <pre>
■ Morning Check
- Sleep: 00:00-09:00
- Body: 9/10
- Mind: 10/10
- Energy: 9/10
- Stress: 0/10
- Stretch: 20 min (morning)

■ Food
- Breakfast (10:00): Oats yogurt (passion fruit, walnuts, almonds, brazil nuts, honey, pumpkin seeds, chia seeds), EVOO 15ml
- Lunch (16:00): Som Tum, Thai-style noodles (shrimp, sea grapes, chili, holy basil)
- Dinner (19:00): Gluten-free pasta, burrata pizza, salad, lasagna, sea bass

■ Workout
Rest Day

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Mac V2 VOLCANO 0.7g (23:00)
Alcohol: 1 cup of beer, 2 glasses of red wine
Coffee: black coffee (17:00) / Cigarettes: 4

■ Personal Notes
マンチーは危険
</pre>

  <h2># 2026-01-22</h2>
  <pre>
■ Morning Check
- Sleep: 01:00-10:00
- Body: 8/10
- Mind: 9/10
- Energy: 8/10
- Stress: 0/10
- Stretch: 20 min (morning)

■ Food
- Breakfast (11:00): Oats yogurt (passion fruit, walnuts, almonds, brazil nuts, honey, pumpkin seeds, chia seeds), EVOO 15ml
- Lunch (14:00): croissant, omelet, mushrooms, beans, tomatoes, lettuce, radish sprouts, Smoothie（avocado, orange, apple, papaya, banana, tempeh）
- Dinner (19:30): Som Tum, Chicken Wings, Nam Ngiao, Riceberry, EVOO 15ml

■ Workout
Back Day: 16:00 ~ 17:00
Bouldering with my friends.

■ Substances
NMN 1g / Res 1g / TMG 0.5g (morning)
Omega3 (EPA+DHA): 1280 mg (morning)
Ginseng: 600 mg × 2 caps × 3/day
Creatine: 5g (before workout)
Ashwagandha: 300 mg (night)
Cannabis: Hybrid 0.3g (17:30), freezer jam + head lock + MAC V2 1g (23:00)
Alcohol: 0 / Cigarettes: 4
Coffee: before workout

■ Personal Notes
</pre>

  <h2># 2026-01-21</h2>
  <pre>
■ Morning Check
- Sleep: 01:00-10:30
- Body: 7/10
- Mind: 8/10
- Energy: 7/10
- Stress: 0/10
- Stretch: 20 min (morning)

■ Food
- Breakfast (11:00): Oats yogurt (passion fruit, walnuts, almonds, banana, brazil nuts, honey, pumpkin seeds, chia seeds), EVOO 15ml
- Lunch (14:30): Gapao Rice, Som Tam
- Dinner (20:00): Riceberry, Tempeh, Egg, Spinach, Broccoli, Pork, miso soup, EVOO 15ml

■ Workout
Arm Day: 16:20 ~ 18:00 / Protein 15g

1. Preacher Curl → Dumbbell Curl
20kg × 10 → 7.5kg × 10
20kg × 10 → 7.5kg × 10
20kg × (5+5c) → 7.5kg × (4+6c)
*note: Because of back pain, I switched from Barbell Curl to Preacher Curl.

2. Hammer Curl (Drop Set
12.5kg × 10 → 7.5kg × 10
12.5kg × 10 → 7.5kg × (6+4c)

3. Press Down with Bar
50kg × 10
50kg × 10
50kg × (9+1c) 
*note: Don't move arm position. Use thumless grip.

4. Press Down with Rope
50kg × (7+3c)
50kg × (6+4c)
50kg × (4+5c)

5. Narrow Bench Press → Dumbbell French Press
10kg × 20 → 10kg × 20
10kg × (15+5c) → 10kg × (15+5c)

■ Substances
NMN 1000mg / Resveratrol 1000mg / TMG 500mg  
Ginseng extract: 2 × 3 times
Cannabis: 0.4g (18:00), 0.5g freezer jam (23:40)
Alcohol: 0 / Cigarettes: 3
Coffee: before workout

■ Personal Notes
Today I'm feeling physically and mentally good Maybe because of not eating for a long time since 17:00 yesterday.

✓ Learning: 
mid-night meal makes your morning and the next day’s condition worse, I realized from my log.

✓ Intuition:
- 人生のネタを増やす
- Concentrate on muscle training in whole life. Having muscle means daily making efforts and can get respect.
- I decided to start my blog again with my favorite and strong domain: manablog.org I can get the high rank on Google with English keywords. I'm gonna get tons of #1 rankings for cannabis-related keywords
</pre>

  <h2># 2026-01-20</h2>
  <pre>
■ Record each time
- Water: water 200ml (11:30), peppermint lemon tea 220ml (14:00)
- Digestion: 1 (morning)
- Output / Input: 

■ Morning Check
- Sleep: 1:30-11:00
- Sleep quality: 7
- Mood: 8
- Energy: 8
- Focus: 8
- Stress: 1
- Physical: 8
- Fatigue: body fatigue because of workout
- Pain: muscle pain on my leg
- Urine: normal 
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Meals
- Breakfast: 12:00 - oat bowl (khao mak, oats, passion fruit, walnuts, almonds, banana, brazil nuts, blueberries, honey, pumpkin seeds), water (220ml), EVOO
- Lunch: 16:50 - water 600ml, korean bbq (pork neck, pork shoulder loin), bibimbap (rice, zucchini, carrot, bean sprouts, bracken fern, seaweed), appetizer (cucumber, carrot, onion, vinegar broth)
- Dinner: 

■ Substances
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Ext (4.2 mg): 2 capsules (after breakfast), 2 capsules (after lunch)
- Cannabis: indica 1g (18:30), OG Kush 0.4g (23:50)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee (16:00)

■ Workout
- Rest Day 
- Weight: 
- Treatment: full body massage 2.5 hours

■ Notes / Thought 
Dream: My dog had fun with my relatives - it was a happy dream. 

Do stretches daily. 
Now I need: ball massage, Internal organs massage, neck and shoulder massage, and head massage

Starting today, I'm going to stop using my smartphone because recently I've been using it too much and it's been bad for my life.
</pre>

  <h2># 2026-01-19</h2>
  <pre>
■ Record each time
- Water: 600ml (14:00), water (16:10), protein drink 15g 300ml (17:30), water 600ml (19:15), chamomile and lemon tea 220ml (23:20), camomile honey tea 220,l (00:30), papaya with lemon 
- Digestion: 1 (morning), 1 (afternoon), 1 (afternoon)
- Output / Input: read (14:30-14:45)

■ Morning Check
- Sleep: 23:00-11:30
- Sleep quality: 8
- Mood: 9
- Energy: 9
- Focus: 9
- Stress: 0
- Physical 9
- Fatigue: none
- Pain: none
- Urine: normal 
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Meals
- Breakfast: 12:00 - oatmeal bowl (oats, chia seeds, banana, blueberries, pumpkin seeds, yogurt, walnuts, almonds, brazil nuts, passion fruit, honey), EVOO, water 300ml
- Lunch: 14:30 - green tea (300ml), salmon and fatty salmon rice bowl 2 cups (salmon, fatty salmon, rice, wasabi, pickled ginger)
- Dinner: 19:00 - pad thai (rice noodles, shrimp, bean sprouts, egg, garlic chives, peanuts, lime), papaya smoothie (papaya, mint)
- Night: 

■ Substances
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract (ginsenosides 4.2 mg): 2 capsules (after breakfast), 2 capsules (after lunch), 2 capsules (after dinner)
- Cannabis: jamaican dream strain 0.5g (18:30), jamaican dream 0.5g + permanent traveler 0.5g (21:30), head lock 0.3g (23:50)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee (15:30)

■ Workout
- Leg Day (16:13 ~ 17:38)
- Weight: 61.7 kg
- Treatment: oil massage 1 hour (21:00)

# Squat
- 70kg × 10
- 80kg × 6
- 90kg × 4
- 80kg × 6
- 75kg × 8
- 70kg × 12

# Leg Curl
- 47kg × 12
- 47kg × (10 + 2c)
- 47kg × (8 + 2c)

*note: goal is 12 reps × 47kg. when achieved, increase the weight.

# Jump Squat → Leg Extension
- 10, 10 (60kg)
- 10, 12 (60kg)
- 10, 10 (60kg)

*note: due to back pain, I did normal squats instead of jump squats.

# Calf Raise
- 25kg : 10 (slow) + 10 (fast)
- 25kg = 10 (slow) + 10 (fast)

*note: my ankles are too stiff. need to stretch more.

■ Notes / Thought 
walking with dog (12:40-13:00)
Jamaica Dream strain is great for morning use while traveling, or as a pre-sauna smoke. My score for this strain is 97. 
</pre>
  <h2># 2026-01-18</h2>
  <pre>
■ Mental (morning check)
- Mood: 8/10
- Energy: 8/10
- Focus: 9/10
- Stress: 1/10
- Details: 

■ Physical (morning check)
- Overall: 8/10
- Fatigue: none
- Pain: none
- Digestion: 1 (morning), 1 (afternoon)
- Urine: normal 

■ Biometrics (morning check)
- Sleep: 01:30-10:00
- Sleep quality: 8/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Shoulder Day
- 16:10-18:00
- Weight: 61.3kg
- Water intake: water 600ml, pocari sweat 500ml
- Treatment: meditation (12:30-13:00)

# Rear Raise
- 7.5kg x 10 (back focus), 7.5kg x 10 (side focus), 7.5kg x 10 (pendulum)
- 7.5kg x 10 (back focus), 7.5kg x 10 (side focus), 7.5kg x 10 (pendulum)
- 7.5kg x 10 (back focus), 7.5kg x 10 (side focus), 7.5kg x 10 (pendulum)

# Shoulder Press Machine
- 40kg x (8+1C)
- 50kg x 4
- 60kg x 1
- 55kg x 4
- 50kg x (6+2C)
- 45kg x (8+4C)

# Dumbbell Shoulder Press
- 15kgx10, 12.5kg x (7+3C)
- 15kg x 10, 12.5kg x (6+4C)

*note: feet in support position

# Side Raise
- 10kg x 10, 7.5kg x 15, 5kg x 15
- 10kg x 10, 7.5kg x 15, 5kg x 15

*note: don’t rest more than 2 seconds

■ Output / Input
- Read 22:45-23:00

■ Meals
- Breakfast: 10:40 - water 400ml, mixed nut and fruit oat bowl (oats, chia seeds, pumpkin seeds, honey, brazil nuts, blueberries, almond, walnuts, passion fruit, banana, yogurt), EVOO
- Lunch: 14:00 - water 500ml, miso soup (tofu, wakame, green onion), テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）, salad (lettuce, tomato), banana enzyme juice
- Dinner: 20:20 - shabu shabu (beef, pork, egg, napa cabbage, bok choy, chinese celery, japanese leek, carrot, pumpkin, corn, enoki mushroom, shiitake mushroom, wood ear mushroom, king oyster mushroom, brown beech mushroom, goji berry, jujube), steam rise, water 600ml
- Night: chamomile tea 200ml (22:30)

■ Substances
- Water (misc): 600ml (morning), peppermint tea 200ml (12:00)
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract (ginsenosides 4.2 mg): 2 capsules (after breakfast), 2 capsules (after lunch), 2 capsules (after dinner)
- Cannabis: super boof strain 1g (19:00)
- Cigarettes: 3
- Alcohol: 
- Caffeine: 100ml black coffee (16:00)

■ Notes / Thought 
Not eating late at night helps you feel better in the morning, so it’s better to avoid late-night meals.
</pre>

  <h2># 2026-01-17</h2>
  <pre>
■ Mental (morning check)
- Mood: 9/10
- Energy: 9/10
- Focus: 9/10
- Stress: 0/10
- Details: 

■ Physical (morning check)
- Overall: 9/10
- Fatigue: none
- Pain: none
- Digestion: 1 (morning)
- Urine: normal

■ Biometrics (morning check)
- Sleep: 12:30-10:20
- Sleep quality: 8/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Chest Day
- Weight: 61.3kg
- Water intake: 300ml of protein drink (15g of protein), pocari sweat 500ml, water 600ml
- Treatment: meditation (12:40-13:10)

# Bench Press
- 50kg x 10
- 60kg x 6
- 80kg x 1
- 70kg × 3
- 65kg × 6
- 60kg x 8
- 55kg x (8+4c)

# Dips
- 10
- 10
- 9

# Incline Chest Press
- 40kg x (8+1c)
- 40kg x (6+1c)
- 40kg x (7+3c)

# Pec Fly
- 24kg x 10
- 24kg x (8+2c)
- 24kg x (8+2c)

■ Output / Input

■ Meals
- Breakfast: 11:00 - yogurt bowl (greek yogurt, oats, frozen blueberries, walnuts, pumpkin seeds, passion fruit, honey), EVOO, decaf coffee (100ml)
- Lunch: 14:00 - テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g）, miso soup (tofu, green onion, assorted vegetables), enzyme drink (200ml)
- Dinner: 19:45 - oolong tea 400ml, oyakodon (chicken, egg, onion, rice, scallion, seaweed), tonjiru (pork, daikon radish, carrot, scallion, miso broth)
- Night: peppermint (00:00), slice mango 3 pieces, chocolate 3 pieces, cheese cake half slice 

■ Substances
- Water (misc): 600ml, 600ml, 600ml
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract: 2 capsules (ginsenosides 4.2 mg, after breakfast), 2 (after lunch)
- Cannabis: 0.5g of dutch by book strain (19:00), mimosa 0.5g (21:15), head lock strain 0.4g (00:30)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee 250ml (15:00)

■ Notes
I went to a busy bar street with my friends. The air quality wasn’t great, but the energy was good. It’s nice to go to places like this occasionally.

■ Thought 
</pre>

  <h2># 2026-01-16</h2>
  <pre>■ Mental (morning check)
- Mood: 8/10
- Energy: 9/10
- Focus: 8/10
- Stress: 1/10
- Details: 

■ Physical (morning check)
- Overall: 9/10
- Fatigue: none
- Pain: none
- Digestion: 1 (morning), 1 (afternoon), 1 (night)
- Urine: normal

■ Biometrics (morning check)
- Sleep: 12:00-10:30
- Sleep quality: 7/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Rest Day
- Weight: NA
- Water intake: NA
- Treatment: stretch (21:38-22:00)

■ Output / Input

■ Meals
- Breakfast: 11:00 - water 600ml
- Lunch: 14:30 - negitoro gunkan  2 plates, shrimp avocado sushi 2 plates, surf clam sushi, sea urchin sushi, seared salmon sushi with grated daikon, chawanmushi (egg, dashi stock), miso soup (clams, miso, green onions), green tea 300ml, pickled ginger
- Dinner: 20:00 - water 250ml, fried potatoes, papaya salad (green papaya, tomato, long bean, peanut), fried chicken wings, natto egg rice (steamed rice, natto, raw egg), EVOO
- Night: three horses tea (220ml)

■ Substances
- Water (misc): 200ml, 200ml
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract: 2 capsules (ginsenosides 4.2 mg, after breakfast):
- Cannabis: 0.4g of compound-z (22:00)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee (16:00)

■ Notes

■ Thought 
I started publishing my draft notes on my blog. In the AI era, it's difficult to publish polished information, because the most accurate source is AI itself. So I publish draft notes as a fun activity for myself.
</pre>

  <h2># 2026-01-15</h2>
  <pre>
■ Mental (morning check)
- Mood: 8/10
- Energy: 8/10
- Focus: 7/10
- Stress: 1/10
- Details: 

■ Physical (morning check)
- Overall: 9/10
- Fatigue: none
- Pain: muscle pain of my arm
- Digestion: 1 (morning), 1 (afternoon)
- Urine: normal

■ Biometrics (morning check)
- Sleep: 1:00-11:00
- Sleep quality: 8/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Back Day (16:00~17:00)
- Weight: 61.8kg
- Water intake: protein drink (300ml, 15g of protein), 300ml of black coffee, 1100ml of water
- Treatment: full-body stretch (20:26-20:44)

# Chinning
- 10, 10, 5+5c

# Deadlift
- 60kg × 6
- 100kg × 1

# Bent Over Rowing with Smith Machine
- 40kg × 10
- 60kg × 10
- 80kg × 10
- 80kg × 4
- 60kg × 10
- 50kg × 12

*note: lower the body.

# T-Bar Rowing
- 25kg: 12+3c
- 30kg: 8+2c

# Lat Pulldown
- 45kg: 7+3c
- 45kg: 6+4c
- 45kg: 5+3c

■ Output / Input
- Read: Creativity by OSHO (12:30-12:50)

■ Meals
- Breakfast: 13:00 - water 650ml,pad thai (rice noodles, chicken, egg, tofu, bean sprouts, garlic chives), bean sprouts, lime, walnut, pumpkin seeds, EVOO, pepper mint tea (200ml)
- Lunch: 15:00 - brazil nuts 3 pieces, walnut 5 pieces, pumpkin seed, two boiled egg
- Dinner: 21:00 - water 300ml, falafel pita sandwich (pita bread, falafel, chickpeas, herbs, cabbage, tahini sauce, chili sauce, coriander), shakshuka hummus (hummus, tomato sauce, egg, olive oil, parsley), dolma (grape leaves, rice, herbs, spices, olive oil), roasted potatoes, pickles (cucumber, cabbage, bell pepper), sesame bread ring (sesame seeds, flour), rime juice
- Night: 

■ Substances
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract: 2 capsules (ginsenosides 4.2 mg, after breakfast):
- Cannabis: 0.2g of Blackberry strain (19:00), 0.6g of cheese bakery (22:00)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee (15:30)

■ Notes

■ Thought 
</pre>

  <h2># 2026-01-14</h2>
  <pre>
■ Mental (morning check)
- Mood: 8/10
- Energy: 8/10
- Focus: 8/10
- Stress: 1/10
- Details: Slept well and energized

■ Physical (morning check)
- Overall: 8/10
- Fatigue: none
- Pain: leg injury
- Digestion: 3 time (morning, healthy, no bloating), 1 time (night)
- Urine: no problem 

■ Biometrics (morning check)
- Sleep: 1:00-1000
- Sleep quality: 8/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Arm Day
- Weight: 60.7kg
- Water intake: 500ml, protein drink  300ml (15g of protein)
- Treatment: stretch (10min)

- # Barbell Curl + Dumbbell Curl（Superset)
- 1) BC 17.5kg  × 10c → DC 7.5kg × (7+3c)
- 2) BC 15kg × (7+3c) → DC 7.5kg × 10
- 3) BC 15kg × 10 → DC 7.5kg × 10

- # Hammer Curl (Dropset)
- 1) 12.5kg × (7+3c) → 7.5kg × 10
- 2) 12.5kg × (5+5c) → 7.5kg × (5+5c)

- # Press Down with Bar
- 50kg × 10
- 50kg × 10
- 50kg × 8+2c

*note: Lower the bar straight down. Use a thumbless grip.

- # Press Down with Rope Handle
- 45kg × (8+2c)
- 45kg × 10
- 45kg × (8+2c)

- # Triceps Extension
- 26kg × (8+2c)
- 26kg × 10

■ Output / Input
- Read: ツァラトゥストラはこう言った (10:54-11:15, 14:56-15:18, 

■ Meals
- Breakfast: 10:40 - oats, greek yogurt, honey, chia seeds, almond, brazil nuts, pistachios, cashews, pumpkin seeds, blueberries, EVOO, Water Intake (camomile tea 200ml)
- Lunch: 14:00 - salmon, japanese rice, ginger, parsley, green tea (200ml), glilled saba, teriyaki sources, omelet, asparagus, broccoli, carrot, shiitake mushrooms
- Dinner: 20:00 - water 600ml, tempeh hamburger, white rice, miso soup (miso, tofu, enoki mushrooms, shiitake mushrooms, deep-fried tofu pouch, coriander), garden salad (egg, lettuce, cucumber, cherry tomatoes, tomatoes, red bell pepper, walnuts, pumpkin seeds, pomegranate, feta cheese
- Night: water intake: 400ml (camomile tea), dark chocolate: 4 pieces, dry mango slices 5 pieces

■ Substances
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Korean Red Ginseng Extract: 0 capsules (ginsenosides 4.2 mg, after breakfast):
- Cannabis: 0.7(compound z) + 0.6(freezer jam) at 23:00)
- Cigarettes: 3
- Alcohol: 
- Caffeine: black coffee (200ml, 12:00)

■ Notes
I feel energized today, maybe because of ball massage I had yesterday? I don’t know but observe it continuously. (10:00)
I still feel so much energy today. What a great day today. I’m gonna check my condition and observe it continuously. (21:30)

■ Thought 
</pre>
  <h2># 2026-01-13</h2>
  <pre>
■ Mental (morning check)
- Mood: 9/10
- Energy: 9/10
- Focus: 9/10
- Stress: 0/10
- Details: slept very well and the healthy food I ate yesterday makes me feel good and stable

■ Physical (morning check)
- Overall: 8/10
- Pain: scar on my right leg because of trampoline
- Fatigue: none

■ Biometrics (morning check)
- Sleep:12:30-10:30
- Sleep quality: 9/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Rest day
- Weight: NA
- Treatment: stretch (14:26-14:40), meditation (14:42-15:00), Testicular massage (90min)
- Details: NA

■ Output / Input
- Reading: Creativity by OSHO (15:38-16:51)

■ Meals
- Breakfast: 11:40 - oats, blueberries, honey, almond, brazil nuts, pumpkin seed, cashew nuts, peppermint tea
- Lunch: 15:30 - bbq chicken, grilled vegetables, tempeh, broccoli, passion fruit smoothie
- Dinner: 20:30 - thai red pork curry (pork, coconut milk, kaffir lime leaves, red chili), jasmine rice, papaya salad (green papaya, carrot, long beans, peanuts, lime, lettuce, chili), fresh coconut juice 
- Night: 

■ Substances
- NMN: 1,000 mg, Trans Resveratrol: 1,000 mg, TMG: 500 mg (after breakfast)
- Cannabis: 1g(23:00)
- Cigarettes: 3
- Alcohol: 0
- Caffeine: 

■ Notes
■ Thought 
</pre>

  <h2># 2026-01-12</h2>
  <pre>
■ Mental (morning check)
- Mood: 8/10
- Energy: 8/10
- Focus: 8/10
- Stress: 1/10
- Details: slept very well. Looking forward to having a great day today. 

■ Physical (morning check)
- Overall: 7/10
- Pain: scar on my right leg
- Fatigue: none

■ Biometrics (morning check)
- Sleep: 1:00-11:50
- Sleep quality: 8/10
- BMI: NA
- Body Fat: NA
- Muscle Mass: NA
- Body Water: NA

■ Workout
- Rest day
- Weight: NA
- Treatment: none
- Details: NA

■ Meals
- Breakfast: 11:00 - nuts(almond, cashews, macadamia, pistachio), greek yogurt, chia seeds, honey, oats, blueberries, camomile tea
- Lunch: 15:00 - omelette (3 eggs), 50g smoked salmon slice, 2 slices of sourdough toast, green leaf salad, grilled tomatoes, grilled mushrooms, smoothie (beet, pineapple, carrot, apple & orange juice) with homemade tempeh
- Dinner: 20:30 - MK Restaurant (pork, wakame, enoki, wood ear mushrooms, tohu, pork liver, green onions, glass noodles, water spinach, celery)
- Night: 23:00 - Lindt chocolate(78% cocoa)

■ Substances
- NMN: 1,000 mg
- Trans-Resveratrol: 1,000 mg
- TMG (Trimethylglycine): 500 mg
- Cannabis: 1g (23:00)
- Alcohol: 0
- Caffeine: americano (4:30PM)

■ Notes
Add nuts, chocolate more than 70% of cacao, broccoli, liver and pumpkin seed to my meal suggested by AI.

■ Thought 
Suddenly people become angry because the mind seeks to have activity: (*Source: Creativity by OSHO)

> Action is spontaneous and total. Activity is never spontaneous, it comes from the past. You may have been accumulating it for many years, and then it explodes into the present.

> Suddenly you flare up in anger. Everybody becomes aware that it was not needed. Only you cannot see. Everybody feels, “Why are you so angry?” But you will find rationalizations, you will rationalize that it was needed. 

I will maximize my actions and minimize my activities such as cleaning the house and washing dishes. 

Living by habit looks like a good life strategy, but what’s missing is the attitude of constantly searching for ways to minimize effort. 
</pre>

  <h2># 2026-01-11</h2>
  <pre>
■ Mental *morning check
- Mood: 7/10
- Energy: 7/10
- Focus: 7/10
- Stress: 2/10
- Details: The Internet guy came to my house to set up the internet in the morning. And the dog barked so much it made me a little nervous, but it was ok soon after. 

■ Physical *morning check
- Overall: 7/10
- Pain: muscle pain neck 
- Fatigue: none

■ Biometrics *morning check
- Sleep: 8
- Sleep quality: 7/10

■ Workout
- Leg Day
- Weight: 61kg
- Details: I went to a trampoline park and jumped for an hour. I tried many different types of jumps.

■ Meals
- Breakfast: oats, greek yogurt, nuts, blueberries, honey
- Lunch: 
- Fermented Food Rice Bowl (mixed grain rice, kimchi, napa cabbage, takuan, cucumber, salt-koji marinated tofu, wakame, green onions, natto, seaweed)
- テンペバーグ丼（ライスベリー 300g、手作りテンペバーグ 130g、目玉焼き 50g、デミグラスソース 40g） 
- Miso soup (tofu, green onions)
- Dinner: sushi 20 pieces, hot soba, yaki onigiri, aji fry, chawanmushi
- Night: dry mango 5 slices, chia seeds, honey, kinako 

■ Substances
- NMN: 1,000 mg
- Trans-Resveratrol: 1,000 mg
- TMG (Trimethylglycine): 500 mg
- Cannabis: 0.3g (7PM), 0.3g (10PM), 1g(11PM)
- Alcohol: 0
- Caffeine: 1 black coffee (3PM)

■ Notes
I went to a trampoline place with my friends. It was so much fun and good for the leg training. 

■ Thought
The difference between action and activity is interesting: (*Source: Creativity by Osho)

> Action is spontaneous. Activity is never spontaneous, it comes from the past. You may have been accumulating it for many years, and then it explodes into the present. 

> Activity is goal oriented, action is not. Action is overflowing of energy. Action is in this moment, a response. Just the whole existence meets you, confronts you. The birds are singing and you start singing. Suddenly it happens. Suddenly you find it is happening, that you have started humming— this is action. 

My undersatanding is that “action is challenge, activity is habit-oriented doing.”
</pre>


</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btnAll = document.getElementById("copyBtn");
    if (btnAll) {
      btnAll.onclick = () => {
        navigator.clipboard.writeText(
          document.getElementById("copy-target").innerText
        ).then(() => alert("All the data has been copied"));
      };
    }

    const btn10 = document.getElementById("copyLast10Btn");
    if (btn10) {
      btn10.onclick = () => {
        const container = document.getElementById("copy-target");
        let textToCopy = "";

        // 1. Get Fixed Section (Goals/Routine)
        const firstPre = container.querySelector('pre');
        if (firstPre && (!firstPre.previousElementSibling || !firstPre.previousElementSibling.tagName.match(/^H2/))) {
          textToCopy += "■ Goals & Routine\n" + firstPre.textContent + "\n\n" + "=".repeat(20) + "\n\n";
        }

        // 2. Get Last 10 Daily Logs
        const allH2s = Array.from(container.querySelectorAll('h2'));
        const dateHeaders = allH2s.filter(h => h.textContent.trim().startsWith('#'));

        // Take top 10 (Reverse Chronological)
        const targetHeaders = dateHeaders.slice(0, 10);

        targetHeaders.forEach((h2) => {
          textToCopy += h2.textContent + "\n"; // Date Header

          let next = h2.nextElementSibling;
          while (next && next.tagName !== 'H2') {
            const ignoreTags = ['SCRIPT', 'STYLE', 'BUTTON', 'NOSCRIPT'];
            if (!ignoreTags.includes(next.tagName)) {
              if (next.textContent.trim() !== "") {
                textToCopy += next.textContent + "\n";
              }
            }
            next = next.nextElementSibling;
          }
          textToCopy += "\n"; // Separator
        });

        if (textToCopy) {
          navigator.clipboard.writeText(textToCopy).then(() => alert("Last 10 days data has been copied"));
        } else {
          alert("No data found to copy.");
        }
      };
    }
  });
</script>
<?php require dirname(__DIR__) . '/footer.php'; ?>