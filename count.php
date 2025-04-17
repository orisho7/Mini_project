<?php
session_start();
include("db.php");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo "Please log in to vote.";
    exit();
}

// Only proceed if this is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_SESSION['username'];
    $game = isset($_POST['game']) ? mysqli_real_escape_string($conn, $_POST['game']) : '';

    // FIRST: Check if user already voted for this game
    $checkQuery = "SELECT * FROM votes WHERE username = '$username' AND game_name = '$game'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "You've already voted for this game!";
        exit();
    }

    // If not voted before, record the vote
    $score = 1; // Force 1 vote per click (no multiple increments)
    $insertQuery = "INSERT INTO votes (username, game_name, score) VALUES ('$username', '$game', $score)";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Vote recorded successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>