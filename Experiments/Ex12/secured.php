<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Secured Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #43cea2, #185a9d);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .secured-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            width: 400px;
            text-align: center;
            backdrop-filter: blur(8px);
        }

        .secured-box h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
        }

        .secured-box p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .secured-box a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ff4e50;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .secured-box a:hover {
            background-color: #e84346;
        }
    </style>
</head>
<body>

<div class="secured-box">
    <h2>Welcome to the Secured Page</h2>
    <p>Hello, <strong><?php echo $_SESSION['username']; ?></strong>! You are successfully logged in.</p>

    <a href="logout_process.php">Logout</a>
</div>

</body>
</html>
