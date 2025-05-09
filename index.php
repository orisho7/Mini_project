<?php
session_start();
include("../includes/gameo.php");
include("../includes/profile_popup.php");
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameRank</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/winners.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="../assets/js/navbar.js"></script>


    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Optimized Google Fonts loading -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap"
        media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" media="print"
        onload="this.media='all'">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" media="print"
        onload="this.media='all'">

    <!-- Fallback in case JavaScript is disabled -->
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap">
    </noscript>


</head>

<body>

    <!-- Background Video -->
    <video autoplay muted loop id="myVideo">
        <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
    </video>

    <!-- Navigation Bar fetching -->
    <?php include("../includes/navbar.php"); ?>

    <div class="content">
        <!-- Main Container -->
        <div class="container">
            <video autoplay muted loop id="background-video">
                <source src="../assets/photos/90346-619556734_small.mp4" type="video/mp4">
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="mos">
                <pre>Welcome <?php if ($username) {
                                    echo $username;
                                } else echo "Newcomer"; ?> to  </pre>
                <pre>GameRank</pre>
                <pre>A ranking website for gamers</pre>
                <button class="button" onclick="window.location.href='../pages/Voting.php'">
                    <span>Vote Now</span>
                </button>
            </div>
        </div>





        <!-- Winners fetching -->
        <div id="winners" class="winnerContainer"></div>
        <script>
            fetch('../includes/winners.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('winners').innerHTML = data;
                });

            // Scroll animation
            const winnersSection = document.getElementById('winners');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            observer.observe(winnersSection);
        </script>


        <?php include("../includes/footer.php"); ?>
        <script>
            function toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
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
</body>

</html>