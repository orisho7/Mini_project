<?php session_start();
include("db.php");
include("gameo.php");
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
    confetti(); // simple trigger
    </script>
    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="Head">
        <h1 class="H1">THE WINNER IS</h1>
    </div>
    <div class="slide">
        <div class="img_container"> <img class="img" src="<?php echo $game_url; ?>" alt=""></div>
        <div class="slide-content">
            <h1><?php echo $game_name; ?></h1>
            <p><?php echo $game_info; ?></p>
            <h2>👤 <?php echo $vote_count; ?></h2>
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