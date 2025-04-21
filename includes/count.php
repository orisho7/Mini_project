<?php
session_start();
include("../auth/db.php"); // Including the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, show an error message
    header("Location: ../pages/login.php"); // Redirect to login page
}

// Check if the form was submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting the username from the session and game from POST data
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $game_id = (int) $_POST['game_id'];
    $game_name = mysqli_real_escape_string($conn, $_POST['game_name']);
    $score = (int) $_POST['score']; // Ensure the score is an integer

    // Check if votes table exists, if not create it
    $create_votes = "CREATE TABLE IF NOT EXISTS `votes` (
        `vote_id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(255) NOT NULL,
        `game_id` INT NOT NULL,
        `game_name` VARCHAR(255) NOT NULL,
        `score` INT NOT NULL DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`game_id`) REFERENCES `games`(`game_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    mysqli_query($conn, $create_votes);

    // SQL query to check if the user has already voted
    $check_sql = "SELECT id FROM votes WHERE username = '$username' AND game_id = '$game_id'";
    $result = mysqli_query($conn, $check_sql);

    // If the user has voted already, show an error message
    if ($result && mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'You have already voted for this game']);
    } else {
        // If not voted yet, insert the vote into the database
        $insert_sql = "INSERT INTO votes (username, game_id, game_name, score) VALUES ('$username', '$game_id', '$game_name', $score)";
        if (mysqli_query($conn, $insert_sql)) {
            // Success message if the vote is inserted successfully
            echo json_encode(['status' => 'success', 'message' => 'Your vote has been cast!']);
        } else {
            // Error message if the insert failed
            echo json_encode(['status' => 'error', 'message' => 'Failed to record vote: ' . mysqli_error($conn)]);
        }
    }
} else {
    // Only output the error message if this file is being accessed directly
    // and not being included by another file
    if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
}
?>