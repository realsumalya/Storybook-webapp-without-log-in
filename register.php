<?php
// Connect to DB
$conn = new mysqli('localhost', 'root', '', 'storybook');
if ($conn->connect_error) { die('Database error'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $res = $conn->query("INSERT INTO admin (username, password) VALUES ('$username', '$password')");
    echo "Registration successful. <a href='login.php'>Login here</a>";
    exit;
}
?>
<form method="post">
    <input name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Register</button>
</form>
