// count.php
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $game = $_POST["game"];
    $user_id = $_SESSION["user_id"]; // or from cookie/IP/session

    // Connect to DB
    include 'db_connection.php';

    // Prevent multiple votes
    $check = $conn->prepare("SELECT * FROM votes WHERE user_id = ?");
    $check->execute([$user_id]);

    if ($check->rowCount() === 0) {
        $stmt = $conn->prepare("INSERT INTO votes (user_id, game) VALUES (?, ?)");
        $stmt->execute([$user_id, $game]);

        // Optional: update score table if you have one
        $updateScore = $conn->prepare("UPDATE games SET score = score + 1 WHERE name = ?");
        $updateScore->execute([$game]);
    }
}
?>