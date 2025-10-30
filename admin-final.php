<?php
session_start();
// Prevent browser cache showing logged out pages
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
// Session check
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<h2>Welcome, Admin: <?php echo $_SESSION['admin']; ?></h2>
<a href="logout.php">Logout</a>
