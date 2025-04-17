<?php
include('db.php');
$username = $_POST['username'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
mysqli_query($conn, $query);

header("Location: index.php");
exit();
?>