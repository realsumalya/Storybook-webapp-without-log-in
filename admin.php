<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f7fa;
    }
    .sidebar {
      min-height: 100vh;
      background: #232d3b;
      color: #fff;
      position: fixed;
      left: 0; top: 0;
      width: 240px;
      padding-top: 2rem;
      z-index: 100;
    }
    .sidebar a, .sidebar button {
      color: #fff;
      display: block;
      padding: 1rem 1.5rem;
      text-decoration: none;
      font-weight: 500;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      transition: background 0.2s;
    }
    .sidebar a:hover, .sidebar button:hover {
      background: #354052;
      color: #23a6d5;
    }
    .main-content {
      margin-left: 240px;
      padding: 2rem 1.5rem;
      min-height: 100vh;
      background: #f5f7fa;
    }
  </style>
</head>
<body>
  <?php include("sidebar.php"); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="card shadow rounded" style="max-width:650px; margin:2.5rem auto; padding:2rem;">
        <h2 class="mb-3">Welcome, Admin: <?php echo htmlspecialchars($_SESSION['admin']); ?></h2>
        <p class="fs-5">Select an option from the sidebar to get started.</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
