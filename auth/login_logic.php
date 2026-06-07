<?php
session_start();

include(__DIR__ . '/../auth/db.php');

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
    
    try {
        // Use prepared statement to prevent SQL injection
        $query = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                header("Location: ../pages/index");
                exit();
            } else {
                header("Location: ../pages/Login?error=invalid_password");
                exit();
            }
        } else {
            header("Location: ../pages/Login?error=invalid_username");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../pages/Login?error=invalid");
        exit();
    }
} else {
    header("Location: ../pages/Login?error=invalid");
    exit();
}
?>
