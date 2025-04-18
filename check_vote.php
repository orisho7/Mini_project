<?php
session_start();
include("db.php");
$username = $_SESSION['username'];
$check_sql = "SELECT game_name FROM votes WHERE username = '$username'";
$result = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($result) > 0) {
    echo json_encode(["hasvoted" => true]);
} else {
    echo json_encode(["hasvoted" => false]);
}




?>