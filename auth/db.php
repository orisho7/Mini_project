<?php

// InfinityFree database configuration
$servername = "sql302.infinityfree.com";  // InfinityFree MySQL server
$username = "if0_38924002";           // Your InfinityFree username
$password = "BCrRNmpwlaMR";  // Replace with your actual password
$dbname = "if0_38924002_login_db2";   // Your database name (usually username_dbname)

// Alternative: If you have different credentials, update these variables
// $servername = "your_hostname";
// $username = "your_username"; 
// $password = "your_password";
// $dbname = "your_database_name";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>