<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: secured.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 25px;
            color: #333;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .login-box button {
            background-color: #0072ff;
            color: white;
            padding: 12px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-box button:hover {
            background-color: #005bbb;
        }

        .error {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Form</h2>

    <form action="login_process.php" method="POST">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Login</button>
    </form>

    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error'>Invalid username or password!</p>";
    }
    ?>
</div>

</body>
</html>
