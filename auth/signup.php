<?php
session_start();
include('../auth/db.php');

// Force the browser to not cache this page

// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<?php

$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the database
$query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
$result = mysqli_query($conn, $query);

if ($result) {
    // Set session for the new user
    $_SESSION['username'] = $username;

    // Redirect to homepage or index page
    header("Location: ../pages/index.php");
    exit();
} else {
    // Show error (you can improve this with better messages/logging)
    header("Location: login.php?error=Signup failed: Duplicate entry '$username' for key 'username'");
}
?>