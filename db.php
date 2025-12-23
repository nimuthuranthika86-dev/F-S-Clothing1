<?php
// db.php
$host = "localhost";
$user = "root";      // Your MySQL username
$pass = "";          // Your MySQL password (empty for XAMPP)
$db   = "fs_clothing";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>