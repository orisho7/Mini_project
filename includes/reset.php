<?php
session_start();
include(dirname(__DIR__) . "/auth/db.php");
$username = $_SESSION['username'];
$query_reset = "DELETE FROM votes WHERE username = '$username'";
$result_reset = mysqli_query($conn, $query_reset);

header('Content-Type: application/json');
if ($result_reset) {
    echo json_encode(['status' => 'success', 'message' => 'Votes reset successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
}
?>