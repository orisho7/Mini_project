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
        <!-- Logo and site name -->
        <div class="logo-container">
            <a href="index" class="icon site-name">GameRank</a>
        </div>

        <!-- Desktop Navigation -->
        <ul class="nav-links">
            <li>
                            <a href="/pages/index" class="links">
                <b>Home</b>
            </a>
        </li>
        <li>
            <a href="/pages/Awards" class="links">
                <b>Most Voted</b>
            </a>
            </li>
            <li>
                <a href="#footer" class="links">
                    <b>Contact</b>
                </a>
            </li>
            <?php
            if (isset($_SESSION['username'])) {
                echo '
                <li>
                    <button class="btn" onclick="popup()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </button>
                </li>
                <li class="login">
                    <a href="../auth/logout" class="links">
                        <b><span class="border-text">Sign Out</span></b>
                    </a>
                </li>';
            } else {
                echo '
                <li class="login">
                    <a href="Login" class="links">
                        <b><span class="border-text">Login</span></b>
                    </a>
                </li>';
            }
            ?>
        </ul>
        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <div class="sidebar">
        <button class="sidebar-close" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x"
                viewBox="0 0 16 16">
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </button>
        <ul class="nav-links-mobile">
            <li>
                <a href="pages/index" class="links" onclick="toggleSidebar()">
                    <b>Home</b>
                </a>
            </li>
            <li>
                <a href="pages/Awards" class="links" onclick="toggleSidebar()">
                    <b>Most Voted</b>
                </a>
            </li>
            <li>

                <a href="#footer" class="links" onclick="toggleSidebar()">
                    <b>Contact</b>
                </a>
            </li>

            <?php
            if (isset($_SESSION['username'])) {
                echo '
                <li>
                    <button class="btn" onclick="popup(); toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </button>
                </li>
                <li class="login">
                    <a href="../auth/logout" class="links" onclick="toggleSidebar()">
                        <b><span class="border-text">Sign Out</span></b>
                    </a>
                </li>';
            } else {
                echo '
                <li class="login">
                    <a href="Login" class="links" onclick="toggleSidebar()">
                        <b><span class="border-text">Login</span></b>
                    </a>
                </li>';
            }
            ?>
        </ul>
    </div>
</div>

<script>
// Toggle sidebar function
function toggleSidebar() {
    const sidebar_ = document.querySelector('.sidebar');
    const overlay_ = document.querySelector('.sidebar-overlay');
    sidebar_.classList.toggle('active');
    overlay_.classList.toggle('active');
}

// Scroll effect for navbar
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var navbar = document.querySelector('.navbar');
        if (!navbar) return;
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }, 300);
});
</script>