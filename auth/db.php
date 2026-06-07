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
        $password = "BCrRNmpwlaMR";
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
$conn = null;
try {
    $conn = @mysqli_connect($servername, $username, $password, $dbname, (int)$port);
} catch (mysqli_sql_exception $e) {
    // Connection failed; error is caught and handled below
}

if (!$conn) {
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
        if (!$servername_env) {
            echo "<h1>Database Configuration Required</h1>";
            echo "<p>Your GameRank application is running on Vercel, but environment variables for the database are missing.</p>";
            echo "<p>Please configure these environment variables in your Vercel Project Dashboard (<strong>Settings &gt; Environment Variables</strong>):</p>";
            echo "<pre style='color:#a9b7c6;'>";
            echo "DB_HOST = (your-cloud-database-hostname)\n";
            echo "DB_USER = (your-database-username)\n";
            echo "DB_PASSWORD = (your-database-password)\n";
            echo "DB_NAME = (your-database-name)\n";
            echo "DB_PORT = (usually 3306)\n";
            echo "</pre>";
        } else {
            echo "<h1>Database Connection Failed</h1>";
            echo "<p>The application attempted to connect to your configured database server but failed.</p>";
            echo "<p><strong>Error Message:</strong></p>";
            echo "<pre>" . htmlspecialchars(mysqli_connect_error()) . "</pre>";
            echo "<table>";
            echo "<tr><td><strong>DB_HOST</strong></td><td>" . htmlspecialchars($servername) . "</td></tr>";
            echo "<tr><td><strong>DB_USER</strong></td><td>" . htmlspecialchars($username) . "</td></tr>";
            echo "<tr><td><strong>DB_NAME</strong></td><td>" . htmlspecialchars($dbname) . "</td></tr>";
            echo "<tr><td><strong>DB_PORT</strong></td><td>" . htmlspecialchars($port) . "</td></tr>";
            echo "</table>";
        }

        if (strpos($servername, 'infinityfree.com') !== false) {
            echo "<div style='margin-top:20px;padding:15px;background:#3a2500;border:1px solid #ffaa00;border-radius:4px;color:#ffaa00;'>";
            echo "<strong>Network Access Restriction Alert:</strong><br>";
            echo "You are pointing to an InfinityFree database. InfinityFree strictly blocks external MySQL connections. Vercel cannot reach this database. You must use a database hosting provider that allows remote external connections (e.g. Aiven, Clever Cloud, alwaysdata, etc.) and configure it in Vercel's Environment Variables.";
            echo "</div>";
        }
        echo "</div>";
        echo "</body></html>";
        exit();
    }
    die("Database connection failed: " . mysqli_connect_error());
}

?>