<?php
include(dirname(__DIR__) . "/auth/db.php");

try {
    // Get the most voted game with its URL and info
    $query = "SELECT g.game_name, g.game_url, g.info, COUNT(*) as vote_count 
              FROM votes v 
              JOIN games g ON g.game_id = v.game_id 
              GROUP BY g.game_id, g.game_name, g.game_url, g.info
              ORDER BY vote_count DESC 
              LIMIT 1";

    $stmt = $conn->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $game_info = $row['info'];
        $game_url = $row['game_url'];
        $game_name = $row['game_name'];
        $vote_count = $row['vote_count'];
    } else {
        $game_info = null;
        $game_url = null;
        $game_name = null;
        $vote_count = 0;
    }
} catch (PDOException $e) {
    $game_info = null;
    $game_url = null;
    $game_name = null;
    $vote_count = 0;
}

// Get the username from session
$username = isset($_SESSION['username']) ? trim($_SESSION['username']) : null;

// Get the game the current user voted for (one vote per user)
$game_urlvoted = null;
$game_namevoted = null;

if ($username) {
    try {
        $queryvoted = "SELECT g.game_url, g.game_name 
                       FROM votes v 
                       JOIN games g ON g.game_id = v.game_id 
                       WHERE v.username = :username 
                       LIMIT 1";
        $stmt_voted = $conn->prepare($queryvoted);
        $stmt_voted->execute([':username' => $username]);
        $rowvoted = $stmt_voted->fetch(PDO::FETCH_ASSOC);

        if ($rowvoted) {
            $game_urlvoted = $rowvoted['game_url'];
            $game_namevoted = $rowvoted['game_name'];
        }
    } catch (PDOException $e) {
        // Silent fail
    }
}
?>