<?php
// Check for Rocket League vote if the user did vote indeed
include("db.php");

// Get the most voted game with its URL
$query = "SELECT g.game_name, g.game_url,g.info, COUNT(*) as vote_count 
          FROM votes v 
          JOIN games g ON g.game_id = v.game_id 
          GROUP BY g.game_id, g.game_name, g.game_url ,g.info
          ORDER BY vote_count DESC 
          LIMIT 1";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $game_info = $row['info'];
    $game_url = $row['game_url'];
    $game_name = $row['game_name'];
    $vote_count = $row['vote_count'];

    // Add htmlspecialchars for security

} else {
    echo "No votes found yet!";
}




?>