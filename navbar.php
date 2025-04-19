<link rel="stylesheet" href="navbar.css">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
<div class="navcontainer">
    <nav class="navbar">
        <ul> <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '
    <li class="login">
        <a href="logout.php" class="links">
            <b><span class="border-text">Signout</span></b>
        </a>
    </li>';
        } else {
            echo '
    <li class="login">
        <a href="Login.php" class="links">
            <b><span class="border-text">Login</span></b>
        </a>
    </li>
   ';
        }
        ?>


            <li>
                <a href="file:///C:/Users/apood/Desktop/Mini_project/index.html" class="links">
                    <b>About us</b>
                </a>
            </li>
            <li>
                <a href="file:///C:/Users/apood/Desktop/Mini_project/index.html" class="links">
                    <b>Contact</b>
                </a>
            </li>
            <li>
                <a href="http://localhost/Mini_project/Awards.php" class="links">
                    <b>Most voted</b>
                </a>
            </li>
            <li>
                <a href="file:///C:/Users/apood/Desktop/Mini_project/index.php" class="links">
                    <b>home</b>
                </a>
            </li>

            <div class="site-name">

                <a href="index.php" class="icon">GameRank</a>
            </div>
        </ul>
    </nav>
</div>