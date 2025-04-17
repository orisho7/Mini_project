<?php
session_start();

// Prevent going to login page if already logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php");
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
    <script>
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null
        };
    </script>
    <title>Login Page</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body,
        html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        #myVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form,
        .signup-form {
            display: flex;
            flex-direction: column;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            gap: 15px;
            width: 400px;

            height: 400px;
        }

        .name,
        input[type="password"] {
            font-size: 18px;
            padding: 20px;
            border: 2px solid rgb(0, 0, 0);
            border-radius: 8px;
            background-color: #1e0f00;
            color: white;
            caret-color: white;

        }

        input::placeholder {
            color: rgb(255, 255, 255);
            /* Placeholder color */
        }

        .submit {
            background-color: rgb(255, 115, 0);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            align-self: center;
            width: 100%;
        }

        .submit:hover {
            background-color: rgba(255, 115, 0, 0.73);
        }

        .Head {
            color: white;
        }

        .signup,
        .login {
            color: rgb(255, 136, 0);
            text-decoration: none;
            align-self: flex-end;
        }
    </style>
    <script>
        function showSignup() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'flex';
        }

        function showLogin() {
            document.getElementById('signup-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'flex';
        }
        // Prevent going back to login after logout
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body>

    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>

    <div class="login-container">
        <form id="login-form" class="login-form" action="login_logic.php" method="post">
            <h1 class="Head" align="center">Login</h1>
            <input class="name" type="text" name="username" placeholder="👤 Username" required>
            <input type="password" name="password" placeholder="🛑 Password" required>
            <a class="signup" href="#" onclick="showSignup()">Signup</a>
            <input class="submit" type="submit" value="Login">
        </form>
        <form id="signup-form" class="signup-form" style="display: none;" action="signup.php" method="post">
            <h1 class="Head" align="center">Signup</h1>
            <input class="name" type="text" name="username" placeholder="👤 Username" required>
            <input type="password" name="password" placeholder="🛑 Password" required>
            <a class="login" href="#" onclick="showLogin()">Login</a>
            <input class="submit" type="submit" value="Login">
        </form>
    </div>

</body>

</html>