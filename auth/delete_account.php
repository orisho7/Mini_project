<?PHP
session_start();
include("../auth/db.php");

<<<<<<< HEAD
=======
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/Login");
    exit();
}

>>>>>>> 3a8dd2cd54d179857f05f9161b70c018fd33f2ad
$username = $_SESSION['username'];

$query = "DELETE FROM users WHERE username = '$username'";

$result = mysqli_query($conn, $query);
$query2 = "DELETE FROM votes WHERE username = '$username'";
$result2 = mysqli_query($conn, $query2);
session_destroy();
<<<<<<< HEAD
header("Location: ../pages/index.php");
=======
header("Location: ../pages/index");
exit();
>>>>>>> 3a8dd2cd54d179857f05f9161b70c018fd33f2ad
?>
