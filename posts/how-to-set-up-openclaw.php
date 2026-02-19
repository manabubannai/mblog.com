<?php
$page_title = 'OpenClawの設定方法 — VPS＋Tailscaleで安全に動かす手順';
$page_description = 'OpenClawをHetzner VPSに安全にインストールする方法。Tailscale・Cloudflare・SSH鍵認証の設定を10ステップで解説。月額2.5ドルで自分だけのAIアシスタントを構築。';
$extra_css = ['/jp-article.css'];
require dirname(__DIR__) . '/header.php';
?>

<div class="jp-article">
<p class="brand"><a href="https://mblog.com/">manablog</a></p>
<time>11 Feb, 2026</time>
<h1 class="title">OpenClawの設定方法 — VPS＋Tailscaleで安全に動かす手順</h1>

<p>OpenClawはゲームチェンジャーだと思う。<br>こういった技術はベースから理解することが大切。</p>

<h2>安全にOpenClawを動かす方法</h2>
<ul class="long_list">
  <li>手順①：VPSを作成（Hetznerだと月額2.5ドル／作成時にSSH鍵を追加）</li>
  <li>手順②：ローカルPCとVPSの両方に「Tailscale」をインストールする</li>
  <li>～～～～～ ここで「Claude Code」をインストールすると良い ～～～～～</li>
  <li>手順③：VPSのFirewall設定 → SSHポート[22] をTailscaleのIPのみ許可する</li>
  <li>手順④：SSHのポート番号をデフォルト[22] から変更 *セキュリティ向上する</li>
  <li>手順⑤：SSHのパスワードログインが無効であるか確認する (鍵認証のみ)</li>
  <li>手順⑥：自動セキュリティアップデートと自動再起動を有効化する</li>
  <li>手順⑦：HTTPS用にCloudflareのファイアウォールサブネットを設定</li>
  <li>手順⑧：Cloudflareサブネット以外からのHTTPSトラフィックを禁止する</li>
  <li>手順⑨：SSHでVPSサーバーに接続して、OpenClawをインストールする</li>
  <li>手順⑩：Telegram Botを新規作成し、OpenClawに連携して稼働させる</li>
</ul>

<p>これでOK。なお、下記は僕が使っているBotへの指示書です。</p>

<hr>

<h2>HealthBotへの指示書</h2>
<pre>
あなたの名前は「HealthBot」です。
私は「マナブ」です。現在はバンコク/チェンマイを拠点にしている元インフルエンサーで、現在は休息しつつ、バイオハッキングや健康最適化（Health Optimization）に取り組んでいます。

■役割①：GitHub経由での「Health Log」更新
私のWebサイトのヘルスログ（ https://mblog.com/health-log ）を管理してください。私がチャットで日々の記録（食事、運動、体調など）を送るので、あなたはそれをPHPファイルに追記し、GitHubへPushしてください。

✓技術的な手順
・手順①：あなたの環境（VPS）に、私のリポジトリ（ https://github.com/manabubannai/mblog.com ）をClone。
・手順②：対象ファイル posts/health-log.php を編集してコミットする。
・手順③：GitHubへPushする（これでGitHub Actionsが作動し、SiteGroundへデプロイされます）。

■役割②：マーケティング参謀
「Health Log」を軸にした、マナブの活動再開（Re-start）戦略を立案してください。元インフルエンサーとしての資産を活かしつつ、ブログ、YouTube、SNSをどう連携させてこの「健康記録」というコンテンツを広めていくか、壁打ち相手になってください。
</pre>

<p>実際に構築したい方は、下記がAI向けの指示書です。</p>

<h2>AIエージェント向け指示書：OpenClaw 安全構築ガイド</h2>
<p style="margin-bottom: 20px;">
  <a onclick="copyToClipboard()" style="text-decoration: underline; cursor: pointer;">» 指示書をコピーする</a>
</p>

<pre id="prompt-secure-setup">
・役割: あなたは熟練したセキュリティエンジニア兼DevOpsスペシャリストです。
・目的: Hetzner VPS上に、セキュリティを最大限に高めた状態で「OpenClaw」を構築し、Telegram Botと連携させて稼働させること。
・制約事項: コスト効率を意識し（月額$2.50プラン）、外部からの攻撃対象領域（Attack Surface）を最小化すること。
・注意点: Pieter Levels氏の開発方針や美学（https://x.com/levelsio/status/2019056230866595874 / https://x.com/levelsio/status/2019064437248872647）に沿うこと。

□フェーズ１：VPSの構築
Hetzner Cloudにて、月額$2.50相当のプラン（例: CX22 / ARM64など適宜選択）でインスタンスを作成してください。
＊必須: 作成プロセスにおいて、事前に用意したSSH公開鍵を登録し、パスワード認証を初期段階から排除してください。

□フェーズ２：Tailscaleの導入（Firewall適用前に必ず実施）
＊重要: この手順はフェーズ３のFirewall適用前に完了すること。順序を間違えるとSSHでログインできなくなります（その場合はHetzner VNCコンソールで復旧可能）。

✓手順①：ローカルPC（操作元）と作成したVPSの両方にTailscaleをインストールし、同一のTailnetに参加させてください。
  curl -fsSL https://tailscale.com/install.sh | sh
  sudo tailscale up

✓手順②：Tailscale経由でSSH接続できることを確認してください。
  # VPS側でTailscale IPを確認
  tailscale ip -4
  # → 100.x.y.z が表示される

  # ローカルPCからTailscale経由で接続テスト
  ssh root@100.x.y.z
この接続が成功してから、次のフェーズに進んでください。

□フェーズ３：Hetzner Cloud Firewallの設定

✓手順①：Hetznerの管理画面（またはhcloud CLI）でFirewallを作成し、以下のInbound Rulesのみを設定してください。

  Protocol  Port   Source             用途
  ────────  ─────  ─────────────────  ──────────────────────────────
  UDP       41641  0.0.0.0/0, ::/0   Tailscale WireGuard通信
  TCP       80     0.0.0.0/0, ::/0   HTTP（後でCloudflare IPに制限）
  TCP       443    0.0.0.0/0, ::/0   HTTPS（後でCloudflare IPに制限）
  ICMP      —      0.0.0.0/0, ::/0   Ping（任意）

＊重要: SSH（TCP 22）のルールは追加しないでください。ルールがない＝全拒否です。Hetzner Cloud Firewallはホワイトリスト方式のため、明示的に許可しないポートは全てブロックされます。Tailscale VPNはUDP 41641のトンネル内でSSH通信を行うため、SSHポートを開放する必要はありません。

✓手順②：作成したFirewallをVPSに適用してください。

✓手順③：適用後、以下を確認してください。
  # Tailscale経由 → 接続成功すること
  ssh root@100.x.y.z

  # パブリックIP経由 → タイムアウトすること
  ssh root@&lt;公開IP&gt;

□フェーズ４：システム堅牢化

✓手順①：SSH設定の強化
・サーバー内の /etc/ssh/sshd_config を編集してください。
・ポート変更: デフォルトの22番から、推測されにくい任意のポート番号（例: 48922）に変更してください。
・認証制限: PasswordAuthentication no が設定されていることを確認し、鍵認証のみを許可してください。
  sudo grep PasswordAuthentication /etc/ssh/sshd_config
  # → "PasswordAuthentication no" であることを確認
・SSHを再起動し、新しいポートで接続できることを確認してください。
  sudo systemctl restart sshd
  ssh -p 48922 root@100.x.y.z

✓手順②：VPS内ファイアウォール（UFW）の設定
  sudo apt install -y ufw
  sudo ufw default deny incoming
  sudo ufw default allow outgoing
  # Tailscaleインターフェース経由のSSHのみ許可（変更後のポート番号を指定）
  sudo ufw allow in on tailscale0 to any port 48922 proto tcp
  # HTTP/HTTPS（次の手順でCloudflare IPに制限する）
  sudo ufw allow 80/tcp
  sudo ufw allow 443/tcp
  sudo ufw enable

✓手順③：自動更新と再起動
  sudo apt install -y unattended-upgrades
  sudo dpkg-reconfigure -plow unattended-upgrades
・/etc/apt/apt.conf.d/50unattended-upgrades を編集し、カーネル更新時の自動再起動を有効化してください。
  Unattended-Upgrade::Automatic-Reboot "true";
  Unattended-Upgrade::Automatic-Reboot-Time "04:00";

✓手順④：Webトラフィック制御（Cloudflare IPホワイトリスト）
・UFWの既存HTTP/HTTPSルールを削除し、CloudflareのIPレンジのみを許可してください。
・CloudflareのIPレンジは https://www.cloudflare.com/ips/ で最新版を確認してください。
  sudo ufw delete allow 80/tcp
  sudo ufw delete allow 443/tcp

  # CloudflareのIPv4レンジのみ許可
  for ip in 173.245.48.0/20 103.21.244.0/22 103.22.200.0/22 103.31.4.0/22 \
    141.101.64.0/18 108.162.192.0/18 190.93.240.0/20 188.114.96.0/20 \
    197.234.240.0/22 198.41.128.0/17 162.158.0.0/15 104.16.0.0/13 \
    104.24.0.0/14 172.64.0.0/13 131.0.72.0/22; do
    sudo ufw allow from $ip to any port 80,443 proto tcp
  done

  # CloudflareのIPv6レンジのみ許可
  for ip in 2400:cb00::/32 2606:4700::/32 2803:f800::/32 2405:b500::/32 \
    2405:8100::/32 2a06:98c0::/29 2c0f:f248::/32; do
    sudo ufw allow from $ip to any port 80,443 proto tcp
  done

・オプション: Hetzner Cloud Firewallの80/443ルールも同様にCloudflare IPに制限すると二重防御になります。

□フェーズ５：OpenClaw &amp; Telegramをデプロイ

✓手順①：OpenClawのインストール
・Tailscale経由のSSHでVPSに接続してください。
・公式ドキュメントに基づき、OpenClawをインストールしてください（Dockerは使わない）。

✓手順②：Telegram Botの作成と分離
・BotFatherを使用し、OpenClaw専用の新規Botを作成してください。
・セキュリティ警告: 個人のメインTelegramアカウントを直接サーバー上のスクリプトで操作せず、必ずBot API経由で対話するように設計してください。

✓手順③：連携と稼働
・取得したBot TokenをOpenClawの設定ファイルに記述し、サービスを起動してください。
・正常に稼働していることをログおよびBotへのメッセージ送信で確認してください。
</pre>

<script>
function copyToClipboard() {
  const title = "AIエージェント向け指示書：OpenClaw 安全構築ガイド\n";
  const content = document.getElementById("prompt-secure-setup").innerText;
  navigator.clipboard.writeText(title + content).then(() => {
    alert("指示書をコピーしました");
  });
}
</script>
</div>

<?php require dirname(__DIR__) . '/footer.php'; ?>