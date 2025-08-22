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
<<<<<<< HEAD
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: ../pages/index.php");
=======
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
>>>>>>> 3a8dd2cd54d179857f05f9161b70c018fd33f2ad
            exit();
        } else {
            header("Location: ../pages/Login.php?error=invalid_password");
        }
    } else {
<<<<<<< HEAD
        header("Location:  ../pages/Login.php?error=invalid_username");
    }
} else {
    header("Location:  ../pages/Login.php?error=invalid");
=======
        header("Location: ../pages/Login?error=invalid");
        exit();
    }
} else {
    header("Location: ../pages/Login?error=invalid");
    exit();
>>>>>>> 3a8dd2cd54d179857f05f9161b70c018fd33f2ad
}
