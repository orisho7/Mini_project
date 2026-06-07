<?php
session_start();
include(dirname(__DIR__) . "/auth/db.php");

$username = $_SESSION['username'] ?? null;
$status = 'error';
$message = 'User session not active';

if ($username) {
    try {
        $query_reset = "DELETE FROM votes WHERE username = :username";
        $stmt_reset = $conn->prepare($query_reset);
        $stmt_reset->execute([':username' => $username]);
        $status = 'success';
        $message = 'Votes reset successfully.';
    } catch (PDOException $e) {
        $message = 'Failed to reset votes: ' . $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode(['status' => $status, 'message' => $message]);
?>