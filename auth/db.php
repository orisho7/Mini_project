<?php

// Detect running environment (local dev vs. shared hosting)
$http_host = $_SERVER['HTTP_HOST'] ?? '';
$server_addr = $_SERVER['SERVER_ADDR'] ?? '';
$is_local = (strpos($http_host, 'localhost') !== false || 
             strpos($http_host, '127.0.0.1') !== false || 
             $server_addr === '127.0.0.1' || 
             $server_addr === '::1' || 
             strpos($server_addr, '192.168.') === 0 || 
             strpos($server_addr, '10.') === 0 || 
             strpos($server_addr, '172.') === 0 || 
             php_sapi_name() === 'cli');

// Load environment variables (supports DATABASE_URL for Vercel/Supabase integration)
$db_url = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? null;
$servername = $_ENV['DB_HOST'] ?? null;
$username = $_ENV['DB_USER'] ?? null;
$password = $_ENV['DB_PASSWORD'] ?? null;
$dbname = $_ENV['DB_NAME'] ?? null;
$port = $_ENV['DB_PORT'] ?? "5432"; // PostgreSQL default port

if ($db_url) {
    $url = parse_url($db_url);
    $servername = $url["host"] ?? $servername;
    $username = $url["user"] ?? $username;
    $password = $url["pass"] ?? $password;
    $dbname = substr($url["path"], 1) ?: $dbname;
    $port = $url["port"] ?? $port;
}

// Fallback logic for local development
if (!$servername) {
    if ($is_local) {
        $servername = "localhost";
        $username = "postgres";
        $password = ""; // Specify your local Postgres password here
        $dbname = "login_db2";
        $port = "5432";
    }
}

try {
    $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Detect Vercel context
    $is_vercel = isset($_ENV['VERCEL']) || 
                 isset($_SERVER['VERCEL']) || 
                 isset($_SERVER['VERCEL_URL']) || 
                 (strpos($http_host, '.vercel.app') !== false) || 
                 (strpos(__FILE__, '/var/task') === 0);

    if ($is_vercel) {
        http_response_code(503);
        echo "<html><head><title>Database Connection Failed</title><style>body{font-family:sans-serif;background:#121212;color:#fff;padding:40px;text-align:center;}div{max-width:600px;margin:auto;background:#1e1e1e;padding:20px;border-radius:8px;border:1px solid #333;text-align:left;}h1{color:#ff4444;text-align:center;}pre{background:#2d2d2d;padding:15px;border-radius:4px;overflow-x:auto;color:#ff6b6b;}table{width:100%;border-collapse:collapse;margin:20px 0;}td{padding:10px;border-bottom:1px solid #333;}</style></head><body>";
        echo "<div>";
        echo "<h1>Database Connection Failed</h1>";
        echo "<p>The application could not connect to your Supabase PostgreSQL database.</p>";
        echo "<p><strong>Error Message:</strong></p>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        echo "<p>Please ensure you have configured the <strong>DATABASE_URL</strong> environment variable in your Vercel Project Settings.</p>";
        echo "<table>";
        echo "<tr><td><strong>DB_HOST</strong></td><td>" . htmlspecialchars($servername) . "</td></tr>";
        echo "<tr><td><strong>DB_USER</strong></td><td>" . htmlspecialchars($username) . "</td></tr>";
        echo "<tr><td><strong>DB_NAME</strong></td><td>" . htmlspecialchars($dbname) . "</td></tr>";
        echo "<tr><td><strong>DB_PORT</strong></td><td>" . htmlspecialchars($port) . "</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "</body></html>";
        exit();
    }
    die("Database connection failed: " . $e->getMessage());
}