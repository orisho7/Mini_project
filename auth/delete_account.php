<?PHP
session_start();
include("../auth/db.php");

$username = $_SESSION['username'];

$query = "DELETE FROM users WHERE username = '$username'";

$result = mysqli_query($conn, $query);
$query2 = "DELETE FROM votes WHERE username = '$username'";
$result2 = mysqli_query($conn, $query2);
session_destroy();
header("Location: ../pages/index.php");
?>
