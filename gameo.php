<?php
// Check for Rocket League vote if the user did vote indeed
include("db.php");
$query_rocket = "SELECT * FROM votes WHERE username = '$username' AND game_name = 'Rocket League'";
$result_rocket = mysqli_query($conn, $query_rocket);
$voted_rocket = (mysqli_num_rows($result_rocket) > 0) ? 'true' : 'false';
// count the number of Rocket League votes
$query_rocket_count = "SELECT * FROM votes WHERE game_name = 'Rocket League'";
$result_rocket_count = mysqli_query($conn, $query_rocket_count);
$voted_rocket_count = (mysqli_num_rows($result_rocket_count));

echo $voted_rocket_count;

// Check for Cyberpunk votes
$query_cyber = "SELECT * FROM votes WHERE username = '$username' AND game_name = 'Cyberpunk'";
$result_cyber = mysqli_query($conn, $query_cyber);
$voted_cyber = (mysqli_num_rows($result_cyber) > 0) ? 'true' : 'false';
?>