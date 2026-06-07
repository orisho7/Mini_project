<?php
session_start();
include(__DIR__ . "/db.php");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/Login");
    exit();
}

$username = $_SESSION['username'];

try {
    $conn->beginTransaction();
    
    // Delete dependent votes first
    $query_votes = "DELETE FROM votes WHERE username = :username";
    $stmt_votes = $conn->prepare($query_votes);
    $stmt_votes->execute([':username' => $username]);
    
    // Delete user account
    $query_user = "DELETE FROM users WHERE username = :username";
    $stmt_user = $conn->prepare($query_user);
    $stmt_user->execute([':username' => $username]);
    
    $conn->commit();
} catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
}

session_destroy();
header("Location: ../pages/index");
exit();
?>
