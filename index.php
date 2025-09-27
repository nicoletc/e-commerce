<?php
// index.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$loggedIn = !empty($_SESSION['customer_id']);
$customer = $_SESSION['customer_name'] ?? null;

// admin = role 1
$isAdmin  = isset($_SESSION['user_role']) && (int)$_SESSION['user_role'] === 1;
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
            <?php if (!$loggedIn): ?>
              <!-- Not logged in -->
              <a class="btn" href="view/register.php">Create account</a>
              <a class="btn btn--alt" href="view/login.php">Log in</a>

            <?php elseif ($isAdmin): ?>
              <!-- Logged in AND admin -->
              <a class="btn" href="admin/category.php">Category</a>
              <a class="btn btn--alt" href="Actions/logout.php">Logout</a>

            <?php else: ?>
              <!-- Logged in but NOT admin -->
              <a class="btn btn--alt" href="Actions/logout.php">Logout</a>
            <?php endif; ?>
          </div>
        </section>

      </div>
    </div>
  </div>
</body>
</html>
