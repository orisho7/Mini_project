<?php
session_start();

include('../auth/db.php');

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['username'])) {
    header("Location: ../pages/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            if ($username == "admin") {
                $_SESSION['username'] = $username;
                header("Location: ../pages/admin.html");
                exit();
            } else
                $_SESSION['username'] = $username;
            header("Location: ../pages/index.php");
            exit();
        } else {
            header("Location: login.php?error=invalid_password");
        }
    } else {
        header("Location: login.php?error=invalid_username");
    }
} else {
    header("Location: login.php?error=invalid");
}
?>