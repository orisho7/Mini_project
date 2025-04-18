<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    die(json_encode(['status' => 'error', 'message' => 'Please log in to vote']));
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "hello";
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $game = mysqli_real_escape_string($conn, $_POST['game']);

    $check_sql = "SELECT id FROM votes WHERE username = '$username'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        die(json_encode([
            json_encode(["hasvoted" => true]),

            'status' => 'error',
            'message' => 'You can only vote for one game total!'
        ]));
    }

    $insert_sql = "INSERT INTO votes (username, game_name, score) VALUES ('$username', '$game', 1)";
    $result = mysqli_query($conn, $insert_sql);

}
?>