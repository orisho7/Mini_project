<?php
session_start();
include("../auth/db.php");
include("../includes/gameo.php"); 
include("../includes/profile_popup.php");
?>

<script> </script>
<html>

<head>
    <link rel="mark" href="">
    <!-- Preload fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        as="style">

    <!-- Add font-display: swap -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" media="print"
        onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        media="print" onload="this.media='all'">

    <link rel="stylesheet" href="../assets/css/Awards.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="../assets/js/navbar.js"></script>

</head>

<body>
    <div class="content">
        <video autoplay muted loop id="myVideo">
            <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
        </video>

        <?php include("../includes/navbar.php"); ?>


        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
        confetti(); // simple trigger
        </script>

        <div class="Head">
            <h1 class="H1">THE WINNER IS</h1>
        </div>
        <div class="slide">
            <div class="img_container">
                <img class="img" src="<?php echo $game_url; ?>" alt="" width="300" height="400" loading="lazy">
            </div>
            <div class="slide-content">
                <h1 class="H1"><?php echo $game_name; ?></h1>
                <p><?php echo $game_info; ?> 👤 <?php echo $vote_count; ?></p>

                <script>
                fetch('../includes/gameo.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('voteCount').innerText = data;
                    })
                    .catch(error => console.error('Error:', error));
                </script>




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
            </div>

        </div>

        <?php include("../includes/footer.php"); ?>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wait a bit if navbar is loaded via fetch
        setTimeout(function() {
            var navbar = document.querySelector('.navbar');
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