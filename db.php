<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = mysqli_connect("localhost", "root", "", "login_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>