<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../settings/core.php';
require_admin();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Categories</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../Css/auth_base.css">
  <style>
    .wrap{display:grid;gap:18px}
    .row{display:flex;gap:10px;flex-wrap:wrap}
    .tbl{width:100%;border-collapse:collapse}
    .tbl th,.tbl td{padding:10px;border-bottom:1px solid rgba(255,255,255,.08)}
    .actions{display:flex;gap:8px}
  </style>
</head>
<body>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="auth-grid">
        <aside class="auth-visual"><div class="auth-caption">Admin · Categories</div></aside>
        <section class="auth-form">
          <h1 class="auth-title">Manage Categories</h1>

          <!-- CREATE (real form) -->
          <form id="create-form" class="row" autocomplete="off">
            <input id="cat_name" class="input" type="text" maxlength="100" placeholder="Enter category name" required>
            <button class="btn" type="submit">Add</button>
            <a class="btn btn--alt" href="../index.php">Back</a>
          </form>

          <!-- LIST -->
          <table class="tbl">
            <thead><tr><th style="width:60%">Name</th><th>Actions</th></tr></thead>
            <tbody id="tbody"><tr><td colspan="2">Loading…</td></tr></tbody>
          </table>
        </section>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/category.js"></script>
</body>
</html>
