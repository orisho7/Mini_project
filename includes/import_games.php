<?php
include(dirname(__DIR__) . "/auth/db.php");

$games = [];
try {
    // Query 1: Get all game information (id, name, url, etc.) for displaying game cards
    $query_game = "SELECT * FROM games";
    $stmt_game = $conn->query($query_game);
    while ($row = $stmt_game->fetch(PDO::FETCH_ASSOC)) {
        $games[] = $row;
    }
} catch (PDOException $e) {
    // Fail silently
}

$username = $_SESSION['username'] ?? null;
$voted_games = [];

if ($username) {
    try {
        // Query 2: Get voting information for the current user
        $query_votes = "SELECT v.game_id, g.game_name FROM votes v JOIN games g ON v.game_id = g.game_id WHERE v.username = :username";
        $stmt_votes = $conn->prepare($query_votes);
        $stmt_votes->execute([':username' => $username]);
        while ($row = $stmt_votes->fetch(PDO::FETCH_ASSOC)) {
            $voted_games[] = ['id' => $row['game_id'], 'name' => $row['game_name']];
        }
    } catch (PDOException $e) {
        // Fail silently
    }
}
$voted_games_json = json_encode($voted_games);
?>