<head>
  <meta charset="utf-8" />
  <title>Log in</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../Css/auth_base.css">
  <link rel="stylesheet" href="../Css/login_page.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/login.js"></script>

</head>
<body>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="auth-grid">
        <aside class="auth-visual">
          <div class="auth-caption">Welcome back</div>
        </aside>

        <section class="auth-form">
          <h1 class="auth-title">Log in</h1>
          <p class="auth-sub">New here? <a class="to-register" href="register.php">Create an account</a></p>

          <form id="login-form" novalidate>
            <div class="field">
              <label for="lemail">Email</label>
              <input class="input" id="lemail" name="email" type="email" required>
            </div>
            <div class="field">
              <label for="lpass">Password</label>
              <input class="input" id="lpass" name="password" type="password" required>
            </div>
            <button id="login-btn" class="btn" type="submit">Log in</button>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>
