<?php session_start();
include("../auth/db.php");
include("../includes/gameo.php"); ?>
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
    <link rel="stylesheet" href="../assets/css/voting.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
    confetti(); // simple trigger
    </script>
    <video autoplay muted loop id="myVideo">
        <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="Head">
        <h1 class="H1">THE WINNER IS</h1>
    </div>
    <div class="slide">
        <div class="img_container">
            <img class="img" src="<?php echo $game_url; ?>" alt="" width="300" height="400" loading="lazy">
        </div>
        <div class="slide-content">
            <h1><?php echo $game_name; ?></h1>
            <p><?php echo $game_info; ?> 👤 <?php echo $vote_count; ?></p>
      
    <script>
    fetch('../includes/gameo.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('voteCount').innerText = data;
        })
        .catch(error => console.error('Error:', error));
    </script>




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
</body>

</html>