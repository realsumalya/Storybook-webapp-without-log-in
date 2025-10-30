<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'storybook');
if ($conn->connect_error) { die('Database connection error'); }

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $res = $conn->query("SELECT * FROM admin WHERE username='$username'");
    if ($row = $res->fetch_assoc()) {
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['admin'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            echo 'Invalid credentials';
        }
    } else {
        echo 'Invalid credentials';
    }
}
?>
<!-- <form method="post">
    <input name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Login</button>
</form>
 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div style="min-height:100vh; background:#232d3b; display:flex; align-items:center; justify-content:center;">
  <form method="post" class="p-4 rounded shadow" style="background:#353535; min-width:320px; max-width:100%;">
    <h4 class="mb-4 text-center text-light fw-semibold">Admin Login</h4>
    <input name="username" required placeholder="Username" class="form-control mb-3" style="background:#232d3b; color:#fff; border:1px solid #23a6d5;">
    <input type="password" name="password" required placeholder="Password" class="form-control mb-4" style="background:#232d3b; color:#fff; border:1px solid #23a6d5;">
    <button type="submit" class="btn w-100" style="background:#23a6d5; color:#fff; font-weight:500;">Login</button>

  <span style="color:white;">Go Back to <a href="homepage.php" style="color:skyblue;text-decoration: none;">Homepage</a></span>
  </form>

</div>