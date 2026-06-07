<?php

// Detect running environment (local dev vs. shared hosting)
$http_host = $_SERVER['HTTP_HOST'] ?? '';
$is_local = (strpos($http_host, 'localhost') !== false || strpos($http_host, '127.0.0.1') !== false || php_sapi_name() === 'cli');

// Check environment variables first (primarily for Vercel/production configurations)
$servername = $_ENV['DB_HOST'] ?? null;
$username = $_ENV['DB_USER'] ?? null;
$password = $_ENV['DB_PASSWORD'] ?? null;
$dbname = $_ENV['DB_NAME'] ?? null;
$port = $_ENV['DB_PORT'] ?? "3306";

// Fallback logic if environment variables are not configured
if (!$servername) {
    if ($is_local) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_db2";
    } else {
        $servername = "sql302.infinityfree.com";
        $username = "if0_38924002";
        $password = ""; // Specify hosting password here or configure via env
        $dbname = "if0_38924002_login_db2";
    }
}

// Parse DATABASE_URL if available (for cloud databases)
$db_url = $_ENV['DATABASE_URL'] ?? null;
if ($db_url) {
    $url = parse_url($db_url);
    $servername = $url["host"] ?? $servername;
    $username = $url["user"] ?? $username;
    $password = $url["pass"] ?? $password;
    $dbname = substr($url["path"], 1) ?: $dbname;
    $port = $url["port"] ?? $port;
}

$conn = mysqli_connect($servername, $username, $password, $dbname, (int)$port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>