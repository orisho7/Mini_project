<?php

session_start();
include('db.php');
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: ./index");
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get and sanitize input
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // Validate input
    $errors = [];
    
    // Username validation
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } elseif (strlen($username) > 20) {
        $errors[] = "Username must be less than 20 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }
    
    // Password validation
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    } elseif (strlen($password) > 255) {
        $errors[] = "Password is too long";
    }
    
    // If no validation errors, proceed with registration
    if (empty($errors)) {
        
        // Check if username already exists
        $check_query = "SELECT id FROM users WHERE username = ?";
        $check_stmt = mysqli_prepare($conn, $check_query);
        
        if ($check_stmt) {
            mysqli_stmt_bind_param($check_stmt, "s", $username);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);
            
            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                $errors[] = "Username already exists";
            }
            mysqli_stmt_close($check_stmt);
        } else {
            $errors[] = "Database error occurred";
        }
        
        // If username is available, create the account
        if (empty($errors)) {
            
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database using prepared statement
            $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            
            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, "ss", $username, $hashed_password);
                
                if (mysqli_stmt_execute($insert_stmt)) {
                    // Set session for the new user
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = mysqli_insert_id($conn);
                    
                    // Redirect to homepage
                    header("Location: /index");
                    exit();
                } else {
                    $errors[] = "Failed to create account. Please try again.";
                }
                mysqli_stmt_close($insert_stmt);
            } else {
                $errors[] = "Database error occurred";
            }
        }
    }
    
    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        $error_string = urlencode(implode(", ", $errors));
        header("Location: /pages/Login?error=" . $error_string);
        exit();
    }
} else {
    // If not POST request, redirect to login page
    header("Location: /pages/Login");
    exit();
}
?>