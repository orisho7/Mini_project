<?PHP
session_start();
include("../auth/db.php");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/Login.php");
    exit();
}

$username = $_SESSION['username'];

// Delete user votes using prepared statement
$query_votes = "DELETE FROM votes WHERE username = ?";
$stmt_votes = mysqli_prepare($conn, $query_votes);

if ($stmt_votes) {
    mysqli_stmt_bind_param($stmt_votes, "s", $username);
    mysqli_stmt_execute($stmt_votes);
    mysqli_stmt_close($stmt_votes);
}

// Delete user account using prepared statement
$query_user = "DELETE FROM users WHERE username = ?";
$stmt_user = mysqli_prepare($conn, $query_user);

if ($stmt_user) {
    mysqli_stmt_bind_param($stmt_user, "s", $username);
    mysqli_stmt_execute($stmt_user);
    mysqli_stmt_close($stmt_user);
}

// Destroy session and redirect
session_destroy();
header("Location: ../pages/index.php");
exit();
?>
