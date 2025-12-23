<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .signup-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }
        form label {
            display: block;
            margin-top: 12px;
            color: #555;
            font-weight: 600;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        form input:focus {
            outline: none;
            border-color: #4a6cf7;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #4a6cf7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s;
        }
        form input[type="submit"]:hover {
            background: #3a5be0;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            display: block;
            color: #4a6cf7;
            text-decoration: none;
            margin: 8px 0;
            font-size: 14px;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .message {
            margin-top: 16px;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            font-weight: 600;
        }
        .success {
            background: #e6f7e6;
            color: #2e7d32;
        }
        .error {
            background: #ffebee;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" name="signup" value="Sign Up">
        </form>

        <?php
        if (isset($_POST['signup'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            
            if ($stmt->execute()) {
                echo "<div class='message success'>User registered successfully! <a href='signin.php'>Login here</a></div>";
            } else {
                echo "<div class='message error'>Error: " . htmlspecialchars($conn->error) . "</div>";
            }
            $stmt->close();
        }
        ?>

        <div class="links">
            <a href="signin.php">Already have an account?</a>
            <a href="index.html">Back to Home</a>
        </div>
    </div>
</body>
</html>