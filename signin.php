<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
        .signin-container {
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
            border-color: #ea0810ff;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #e4062bff;
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
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4a6cf7;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <h2>Sign In</h2>
        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" name="signin" value="Sign In">
        </form>

        <?php
        if (isset($_POST['signin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prevent SQL injection: use prepared statement
            $stmt = $conn->prepare("SELECT username, password FROM user WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    echo "<div class='message success'>Login successful! Welcome, " . htmlspecialchars($row['username']) . "</div>";
                } else {
                    echo "<div class='message error'>Invalid password!</div>";
                }
            } else {
                echo "<div class='message error'>No user found!</div>";
            }
            $stmt->close();
        }
        ?>

        <a href="index.html" class="back-link">Back to Home</a>
    </div>
</body>
</html>