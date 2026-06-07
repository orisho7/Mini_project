<?php
session_start();
include(dirname(__DIR__) . "/auth/db.php");

$username = $_SESSION['username'] ?? null;
$hasvoted = false;

if ($username) {
    try {
        $check_sql = "SELECT game_name FROM votes WHERE username = :username";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->execute([':username' => $username]);
        if ($stmt_check->fetch()) {
            $hasvoted = true;
        }
    } catch (PDOException $e) {
        // Fail silently
    }
}

header('Content-Type: application/json');
echo json_encode(["hasvoted" => $hasvoted]);
?>