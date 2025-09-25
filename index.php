<?php
// index.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$loggedIn = !empty($_SESSION['customer_id']);
$customer = $_SESSION['customer_name'] ?? null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Welcome</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="Css/auth_base.css">
  <link rel="stylesheet" href="Css/index.css">
</head>
<body>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="auth-grid">
        
        <!-- LEFT PANEL -->
        <aside class="auth-visual">
          <div class="auth-caption">Welcome to Nicole's Website</div>
        </aside>

        <!-- RIGHT PANEL -->
        <section class="auth-form">
          <h1 class="auth-title">
            Welcome<?= $customer ? ', ' . htmlspecialchars($customer) : '!' ?>
          </h1>
          <p class="auth-sub">
            <?= $loggedIn ? 'You are now logged in.' : 'Start by creating an account or logging in.' ?>
          </p>

          <div class="home-cta">
            <?php if ($loggedIn): ?>
              <a class="btn btn--alt" href="Actions/logout.php">Logout</a>
            <?php else: ?>
              <a class="btn" href="view/register.php">Create account</a>
              <a class="btn btn--alt" href="view/login.php">Log in</a>
            <?php endif; ?>
          </div>
        </section>

      </div>
    </div>
  </div>
</body>
</html>
