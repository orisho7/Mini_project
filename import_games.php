<?php
include("db.php");
$query_game = "SELECT * FROM games";
$result_game = mysqli_query($conn, $query_game);
$games = [];
while ($row = mysqli_fetch_assoc($result_game)) {
    $games[] = $row;
}
function print_game_name($games)
{

    foreach ($games as $game) {
        echo $game['game_name'];
    }
}
function print_game_image($games)
{
    foreach ($games as $game) {
        echo $game['game_url'];
    }

}

?>