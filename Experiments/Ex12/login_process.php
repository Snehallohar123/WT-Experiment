<?php
session_start();

$valid_username = "admin";
$valid_password = "password123";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $valid_username && $password === $valid_password) {

    $_SESSION['username'] = $username;
    header("Location: secured.php");
    exit();
} else {
    
    header("Location: login.php?error=1");
    exit();
}
?>
