<?php
session_start();
// Prevent going to login page if already logged in
if (isset($_SESSION['username'])) {
    header("Location: ../pages/index.php");
    exit();
}

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../assets/css/login.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">




</head>

<body>
    <div id="navbar"></div>
    <script>
    fetch('../includes/navbar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('navbar').innerHTML = data;
        });
    </script>

    <?php if (isset($_GET['error'])): ?>
    <div style="color: red; text-align:center;">
        <?php
            if ($_GET['error'] == 'invalid_password')
                echo "⚠️ Invalid password!";
            elseif ($_GET['error'] == 'invalid_username')
                echo "⚠️ Invalid username!";
            elseif (isset($_GET["error"]) && str_contains($_GET["error"], "Duplicate entry")) {
                echo "⚠️ This username is already taken.";
            }

            ?>
    </div>
    <?php endif; ?>




    <video autoplay muted loop id="myVideo">
        <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
    </video>

    <div class="login-container">
        <form id="login-form" class="login-form" action="../auth/login_logic.php" method="post">
            <h1 class="Head" align="center">Login</h1>
            <input class="name" type="text" name="username" placeholder="👤 Username" required>
            <input type="password" name="password" placeholder="🛑 Password" required>
            <a class="signup" href="#" onclick="showSignup()">Signup</a>
            <input class="submit" type="submit" value="Login">
        </form>
        <form id="signup-form" class="signup-form" style="display: none;" action="../auth/signup.php" method="post">
            <h1 class="Head" align="center">Signup</h1>
            <input class="name" type="text" name="username" placeholder="👤 Username" required>
            <input type="password" name="password" placeholder="🛑 Password" required>
            <a class="login" href="#" onclick="showLogin()">Login</a>
            <input class="submit" type="submit" value="Signup">
        </form>
    </div>

</body>

</html>