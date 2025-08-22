<?php
include("../auth/db.php");

// Query 1: Get all game information (id, name, url, etc.) for displaying game cards
$query_game = "SELECT * FROM games";
$result_game = mysqli_query($conn, $query_game);
$games = [];
while ($row = mysqli_fetch_assoc($result_game)) {
    $games[] = $row;
}


$username = $_SESSION['username'];
$voted_games = [];

// Query 2: Get voting information for the current user
// This is used to track which games the user has already voted for so that we can disable the vote button for those games and it can be functional

$query_votes = "SELECT v.game_id, g.game_name FROM votes v JOIN games g ON v.game_id = g.game_id WHERE v.username = '$username'";
$result_votes = mysqli_query($conn, $query_votes);

while ($row = mysqli_fetch_assoc($result_votes)) {
    $voted_games[] = ['id' => $row['game_id'], 'name' => $row['game_name']];
}
$voted_games_json = json_encode($voted_games);

?>