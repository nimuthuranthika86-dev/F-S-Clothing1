<?php
// login.php

include 'config.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit();
    }

    // Prepare an SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT id, full_name, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Login successful
            // In a real app, you would start a session here.
            // For simplicity, we'll just show a welcome message.
            echo "<script>alert('Welcome back, " . htmlspecialchars($user['full_name']) . "!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>