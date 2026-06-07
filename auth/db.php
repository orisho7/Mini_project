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

$servername_env = $_ENV['DB_HOST'] ?? null;
$conn = @mysqli_connect($servername, $username, $password, $dbname, (int)$port);

if (!$conn) {
    // Detect Vercel context
    $is_vercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || (strpos($http_host, 'vercel.app') !== false);
    if ($is_vercel && !$servername_env) {
        http_response_code(503);
        echo "<html><head><title>Database Configuration Required</title><style>body{font-family:sans-serif;background:#121212;color:#fff;padding:40px;text-align:center;}div{max-width:600px;margin:auto;background:#1e1e1e;padding:20px;border-radius:8px;border:1px solid #333;}h1{color:#ff4444;}pre{text-align:left;background:#2d2d2d;padding:15px;border-radius:4px;overflow-x:auto;color:#a9b7c6;}</style></head><body>";
        echo "<div>";
        echo "<h1>Database Configuration Required</h1>";
        echo "<p>Your GameRank application has been deployed on Vercel. However, it cannot connect to the default database (InfinityFree blocks external requests).</p>";
        echo "<p>Please configure your production database credentials in your Vercel Project Dashboard (<strong>Settings &gt; Environment Variables</strong>):</p>";
        echo "<pre>";
        echo "DB_HOST = (your-cloud-database-hostname)\n";
        echo "DB_USER = (your-database-username)\n";
        echo "DB_PASSWORD = (your-database-password)\n";
        echo "DB_NAME = (your-database-name)\n";
        echo "DB_PORT = (usually 3306)\n";
        echo "</pre>";
        echo "<p>Ensure your MySQL server allows remote access (e.g. Aiven, Neon, or Clever Cloud free tiers).</p>";
        echo "</div>";
        echo "</body></html>";
        exit();
    }
    die("Database connection failed: " . mysqli_connect_error());
}

?>