<!-- Preconnect to Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Optimized Google Fonts loading -->
<link rel="preload" as="style"
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap">
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap">

<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" media="print"
    onload="this.media='all'">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" media="print"
    onload="this.media='all'">

<!-- Fallback in case JavaScript is disabled -->
<noscript>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap">
</noscript>

<link rel="stylesheet" href="../assets/css/navbar.css">
<script src="../assets/js/navbar.js"></script>

<div class="navcontainer">
    <nav class="navbar">
        <ul> <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '
    <li class="login">
        <a href="../auth/logout.php" class="links">
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
            <script src="../assets/js/navbar.js"></script>
            <?php if (isset($_SESSION['username'])) { echo '
            <li>
                <button class="btn" onclick="popup()"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg></button>
            </li>';
        }
        ?>
            <li>
                <a href="file:///C:/Users/apood/Desktop/Mini_project/index.html" class="links">
                    <b>Contact</b>
                </a>
            </li>
            <li>
                <a href="Awards.php" class="links">
                    <b>Most voted</b>
                </a>
            </li>
            <li>
                <a href="index.php" class="links">
                    <b>home</b>
                </a>
            </li>

            <div class="site-name">

                <a href="index.php" class="icon">GameRank</a>
            </div>
        </ul>
    </nav>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit if navbar is loaded via fetch
            setTimeout(function() {
                var navbar = document.querySelector('.navbar');
                if (!navbar) return; // If navbar not found, exit
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 10) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }, 300); // Adjust delay if needed
        });
</script>