<?php
// config.php

$servername = "localhost"; // Usually 'localhost' for local development
$username = "root";        // Your MySQL username (default is 'root' for XAMPP)
$password = "";            // Your MySQL password (default is empty for XAMPP)
$dbname = "fs_clothing";   // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>