<?php
session_start();

include('../auth/db.php');

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['username'])) {
    header("Location: ../pages/index");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // Basic validation
    if (empty($username) || empty($password)) {
        header("Location: ../pages/Login?error=invalid_username");
        exit();
    }
    
    // Use prepared statement to prevent SQL injection
    $query = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                mysqli_stmt_close($stmt);
                header("Location: ../pages/index");
                exit();
            } else {
                mysqli_stmt_close($stmt);
                header("Location: ../pages/Login?error=invalid_password");
                exit();
            }
        } else {
            mysqli_stmt_close($stmt);
            header("Location: ../pages/Login?error=invalid_username");
            exit();
        }
    } else {
        header("Location: ../pages/Login?error=invalid");
        exit();
    }
} else {
    header("Location: ../pages/Login?error=invalid");
    exit();
}
