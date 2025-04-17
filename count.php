<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    die(json_encode(['status' => 'error', 'message' => 'Please log in to vote']));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $game = mysqli_real_escape_string($conn, $_POST['game']);

    // Check if user has any existing vote
    $check_sql = "SELECT id FROM votes WHERE username = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        die(json_encode([
            'status' => 'error',
            'message' => 'You can only vote for one game total!'
        ]));
    }

    // Insert new vote
    $insert_sql = "INSERT INTO votes (username, game_name, score) VALUES (?, ?, 1)";
    $stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $game);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Vote recorded']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>