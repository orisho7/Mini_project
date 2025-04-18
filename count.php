<?php
session_start();
include("db.php"); // Including the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, show an error message
    die(json_encode(['status' => 'error', 'message' => 'Please log in to vote']));
}

// Check if the form was submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting the username from the session and game from POST data
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $game = mysqli_real_escape_string($conn, $_POST['game_name']);
    $score = (int) $_POST['score']; // Ensure the score is an integer

    // SQL query to check if the user has already voted
    $check_sql = "SELECT id FROM votes WHERE username = '$username' AND game_name = '$game'";
    $result = mysqli_query($conn, $check_sql);

    // If the user has voted already, show an error message
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'You have already voted for this game']);
    } else {
        // If not voted yet, insert the vote into the database
        $insert_sql = "INSERT INTO votes (username, game_name, score) VALUES ('$username', '$game', $score)";
        if (mysqli_query($conn, $insert_sql)) {
            // Success message if the vote is inserted successfully
            echo json_encode(['status' => 'success', 'message' => 'Your vote has been cast!']);
        } else {
            // Error message if the insert failed
            echo json_encode(['status' => 'error', 'message' => 'Failed to record vote']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>