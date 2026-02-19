<?php
$page_title = 'How to Run OpenClaw Safely — Hetzner VPS + Tailscale Setup';
$page_description = 'How I run OpenClaw on a $2.50/month Hetzner VPS with Tailscale, Cloudflare, and SSH key auth. A step-by-step security guide.';
require dirname(__DIR__) . '/header.php';
?>

<p class="brand"><a href="https://mblog.com/">manablog</a></p>
<time>19 Feb, 2026</time>
<h1 class="title">How to Run OpenClaw Safely — Hetzner VPS + Tailscale Setup</h1>

<p>OpenClaw is a game changer. It is worth understanding.</p>

<p><em>Note: If you're worried about security, <a href="https://x.com/levelsio/status/2023960543959101938" target="_blank">claude-code-telegram</a> is a simpler alternative.</em></p>

<hr>

<p>Here is how I set it up securely:</p>

<ul>
  <li>Step 1: Create a VPS on <a href="https://www.hetzner.com/" target="_blank">Hetzner</a> — $2.50/month. Add your SSH key during setup.</li>
  <li>Step 2: Install <a href="https://tailscale.com/" target="_blank">Tailscale</a> on both your local machine and the VPS.</li>
  <li>~~~ Install Claude Code here ~~~</li>
  <li>Step 3: Firewall — allow SSH port [22] from Tailscale IP only.</li>
  <li>Step 4: Change SSH port from the default [22] to something non-obvious. Reduces attack surface.</li>
  <li>Step 5: Confirm password login is disabled. SSH key auth only.</li>
  <li>Step 6: Enable automatic security updates and auto-restart.</li>
  <li>Step 7: Set up Cloudflare firewall subnets for HTTPS.</li>
  <li>Step 8: Block all HTTPS traffic not from Cloudflare subnets.</li>
  <li>Step 9: SSH into the VPS and install OpenClaw.</li>
  <li>Step 10: Create a new Telegram Bot and connect it to OpenClaw.</li>
</ul>

<p>That's it. Below is the system prompt I use for my bot.</p>

<hr>

<p>My bot is called HealthBot. I use it to manage my <a href="/health-log" target="_blank">Health Log</a> — daily records of food, sleep, and supplements — and as a marketing strategist for my content comeback.</p>

<pre>
Your name is "HealthBot."
My name is Manabu. I'm a former Japanese influencer based in Bangkok / Chiang Mai. I'm currently focused on rest and health optimization (biohacking).

Role 1: Health Log Management via GitHub
Manage my health log at https://mblog.com/health-log. I'll send you daily records (meals, exercise, supplements, etc.) via chat. You'll edit the PHP file and push it to GitHub.

Technical steps:
- Step 1: Clone my repository (https://github.com/manabubannai/mblog.com) to your VPS.
- Step 2: Edit posts/health-log.php and commit.
- Step 3: Push to GitHub (GitHub Actions will deploy to SiteGround automatically).

Role 2: Marketing Strategist
Help me build a re-start strategy centered around the Health Log. Act as a thinking partner — how to use my existing assets (blog, YouTube, newsletter) to share this health experiment and reach people who need it.
</pre>

<p>If you want to build this yourself, below is the full AI agent prompt for the secure setup.</p>

<hr>

<p style="margin-bottom: 20px;"><a onclick="copyToClipboard()" style="text-decoration: underline; cursor: pointer;">» Copy prompt</a></p>

<pre id="prompt-secure-setup">
Role: You are an experienced security engineer and DevOps specialist.
Goal: Set up OpenClaw on a Hetzner VPS with maximum security, connected to a Telegram Bot.
Constraints: Keep costs low ($2.50/month plan). Minimize the external attack surface.
Note: Follow the development philosophy of Pieter Levels (https://x.com/levelsio/status/2019056230866595874 / https://x.com/levelsio/status/2019064437248872647).

Phase 1: Create the VPS
Create an instance on Hetzner Cloud using their ~$2.50/month plan (e.g. CX22 / ARM64).
Important: Register your SSH public key during setup. Disable password auth from the start.

Phase 2: Install Tailscale (do this BEFORE applying the firewall)
Warning: Complete this phase before Phase 3. Wrong order = locked out of SSH. (Recover via Hetzner VNC console if needed.)

Step 1: Install Tailscale on both your local machine and the VPS. Join the same Tailnet.
  curl -fsSL https://tailscale.com/install.sh | sh
  sudo tailscale up

Step 2: Confirm SSH works over Tailscale before proceeding.
  # Get Tailscale IP on the VPS
  tailscale ip -4
  # → returns 100.x.y.z

  # Connect from local machine via Tailscale
  ssh root@100.x.y.z

Phase 3: Hetzner Cloud Firewall

Step 1: Create a firewall in Hetzner with only these inbound rules:

  Protocol  Port   Source             Purpose
  ────────  ─────  ─────────────────  ─────────────────────────────
  UDP       41641  0.0.0.0/0, ::/0   Tailscale WireGuard
  TCP       80     0.0.0.0/0, ::/0   HTTP (restrict to Cloudflare later)
  TCP       443    0.0.0.0/0, ::/0   HTTPS (restrict to Cloudflare later)
  ICMP      —      0.0.0.0/0, ::/0   Ping (optional)

Important: Do NOT add an SSH rule. No rule = blocked by default. Tailscale tunnels SSH over UDP 41641 — no need to expose port 22.

Step 2: Apply the firewall to your VPS.

Step 3: Verify:
  # Via Tailscale → should succeed
  ssh root@100.x.y.z

  # Via public IP → should time out
  ssh root@&lt;public-ip&gt;

Phase 4: System Hardening

Step 1: SSH hardening
Edit /etc/ssh/sshd_config on the server.
- Port: Change from 22 to something non-obvious (e.g. 48922).
- Auth: Confirm PasswordAuthentication is set to "no".
  sudo grep PasswordAuthentication /etc/ssh/sshd_config
  # → "PasswordAuthentication no"
Restart SSH and confirm the new port works:
  sudo systemctl restart sshd
  ssh -p 48922 root@100.x.y.z

Step 2: UFW (internal firewall)
  sudo apt install -y ufw
  sudo ufw default deny incoming
  sudo ufw default allow outgoing
  # Allow SSH only over Tailscale interface (use your new port)
  sudo ufw allow in on tailscale0 to any port 48922 proto tcp
  # HTTP/HTTPS (restrict to Cloudflare in the next step)
  sudo ufw allow 80/tcp
  sudo ufw allow 443/tcp
  sudo ufw enable

Step 3: Automatic updates and restart
  sudo apt install -y unattended-upgrades
  sudo dpkg-reconfigure -plow unattended-upgrades
Edit /etc/apt/apt.conf.d/50unattended-upgrades to enable auto-restart on kernel updates:
  Unattended-Upgrade::Automatic-Reboot "true";
  Unattended-Upgrade::Automatic-Reboot-Time "04:00";

Step 4: Cloudflare IP whitelist for web traffic
Remove the open HTTP/HTTPS rules and restrict to Cloudflare IPs only.
Check the latest Cloudflare IP ranges at https://www.cloudflare.com/ips/
  sudo ufw delete allow 80/tcp
  sudo ufw delete allow 443/tcp

  # Allow Cloudflare IPv4 ranges only
  for ip in 173.245.48.0/20 103.21.244.0/22 103.22.200.0/22 103.31.4.0/22 \
    141.101.64.0/18 108.162.192.0/18 190.93.240.0/20 188.114.96.0/20 \
    197.234.240.0/22 198.41.128.0/17 162.158.0.0/15 104.16.0.0/13 \
    104.24.0.0/14 172.64.0.0/13 131.0.72.0/22; do
    sudo ufw allow from $ip to any port 80,443 proto tcp
  done

  # Allow Cloudflare IPv6 ranges only
  for ip in 2400:cb00::/32 2606:4700::/32 2803:f800::/32 2405:b500::/32 \
    2405:8100::/32 2a06:98c0::/29 2c0f:f248::/32; do
    sudo ufw allow from $ip to any port 80,443 proto tcp
  done

Optional: Apply the same Cloudflare IP restriction at the Hetzner Cloud Firewall level for double protection.

Phase 5: Deploy OpenClaw + Telegram

Step 1: Install OpenClaw
Connect via SSH over Tailscale. Install OpenClaw following the official docs (no Docker).

Step 2: Create a dedicated Telegram Bot
Use BotFather to create a new bot for OpenClaw.
Security note: Do not use your personal Telegram account directly on the server. Always interact via the Bot API.

Step 3: Connect and run
Add the Bot Token to OpenClaw's config and start the service.
Verify via logs and by sending a test message to the bot.
</pre>

<script>
function copyToClipboard() {
  const title = "AI Agent Prompt: OpenClaw Secure Setup\n";
  const content = document.getElementById("prompt-secure-setup").innerText;
  navigator.clipboard.writeText(title + content).then(() => {
    alert("Copied to clipboard");
  });
}
</script>

<?php require dirname(__DIR__) . '/footer.php'; ?>
