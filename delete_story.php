<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'storybook');
$id = intval($_GET['id']);

// (Optional) Delete images from server file system if you want:
// $result = $conn->query("SELECT images FROM storytbl WHERE id = $id");
// $row = $result->fetch_assoc();
// $images = explode(',', $row['images']);
// foreach ($images as $img) { if ($img && file_exists("uploads/$img")) unlink("uploads/$img"); }

$conn->query("DELETE FROM storytbl WHERE id = $id");
header("Location: allstories.php");
exit;
?>
