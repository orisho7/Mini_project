<?php
session_start();
include("db.php");
$username = $_SESSION['username'];
$query_reset = "DELETE FROM votes WHERE username = '$username'";
$result_reset = mysqli_query($conn, $query_reset);
if ($result_reset) {
    echo "Votes reset successfully.";
}

?>