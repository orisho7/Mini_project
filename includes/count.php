<?php
session_start();
include(dirname(__DIR__) . "/auth/db.php"); // Including the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Check if the form was submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $game_id = (int) $_POST['game_id'];
    $game_name = $_POST['game_name'] ?? '';
    $score = (int) $_POST['score']; // Ensure the score is an integer

    try {
        // Check if votes table exists, if not create it (PostgreSQL compatible)
        $create_votes = "CREATE TABLE IF NOT EXISTS votes (
            id SERIAL PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            game_id INTEGER NOT NULL REFERENCES games(game_id),
            game_name VARCHAR(255) NOT NULL,
            score INTEGER NOT NULL DEFAULT 0,
            voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->exec($create_votes);

        // SQL query to check if the user has already voted
        $check_sql = "SELECT id FROM votes WHERE username = :username AND game_id = :game_id";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->execute([
            ':username' => $username,
            ':game_id' => $game_id
        ]);
        
        // If the user has voted already, show an error message
        if ($check_stmt->fetch()) {
            echo json_encode(['status' => 'error', 'message' => 'You have already voted for this game']);
        } else {
            // If not voted yet, insert the vote into the database
            $insert_sql = "INSERT INTO votes (username, game_id, game_name, score) VALUES (:username, :game_id, :game_name, :score)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->execute([
                ':username' => $username,
                ':game_id' => $game_id,
                ':game_name' => $game_name,
                ':score' => $score
            ]);
            echo json_encode(['status' => 'success', 'message' => 'Your vote has been cast!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database operation failed: ' . $e->getMessage()]);
    }
} 
?>