<?php session_start();
include("db.php");
include("gameo.php");
$num_rocket = ($result_rocket);
?>
<html>

<head>
    <link rel="mark" href="">
    <link rel="stylesheet" href="Awards.css">

    <link rel="stylesheet" href="voting.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div id="navbar"></div>

    <script>
        fetch('navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar').innerHTML = data;
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        confetti(text: "🔥🔥🔥" {

            particleCount: 100,
            startVelocity: 30,
            spread: 360,
            origin: {
                x: 0
            }
        }); // simple trigger
    </script>
    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="Head">
        <h1 class="H1">THE WINNER IS</h1>
    </div>
    <div class="slide">
        <img class="img" width="100%" , height="100%"
            src="photos/rocket_league__2015__folder_icon_v2_by_foldericonboy_djculhc-375w-2x_2.png" alt="">
        <div class="slide-content">
            <h1>Rocket League</h1>
            <p>Rocket League is a fast-paced sports game that blends soccer with rocket-powered cars.
                Developed by Psyonix, it launched in 2015 and quickly gained worldwide popularity.
                Players use customizable vehicles to hit a large ball into the opponent’s goal.
                The game offers various multiplayer modes, from casual to competitive ranked matches.
                Rocket League also thrives in esports through the Rocket League Championship Series (RLCS).</p>
            <h2>👤 <span id="voteCount">0</span></h2>
        </div>

    </div>

    <script>
        fetch('gameo.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('voteCount').innerText = data;
            })
            .catch(error => console.error('Error:', error));
    </script>




    </div>

</body>

</html>