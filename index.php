<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "Newcomer";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameRank</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="winners.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Background Video -->
    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>

    <!-- Navigation Bar fetching -->
    <div id="navbar"></div>
    <script>
        fetch('navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar').innerHTML = data;
            });
    </script>

    <div class="content">
        <!-- Main Container -->
        <div class="container">
            <video autoplay muted loop id="background-video">
                <source src="photos/90346-619556734_small.mp4" type="video/mp4">
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="mos">
                <pre>Welcome <?php echo $username; ?> to  </pre>

                <pre>GameRank</pre>
                <pre>A ranking website for gamers</pre>
                <button class="button" onclick="window.location.href='Voting.php'">
                    <span>Vote Now</span>
                </button>
            </div>
        </div>

        <!-- Winners fetching -->
        <div id="winners"></div>
        <script>
            fetch('winners.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('winners').innerHTML = data;
                });
        </script>

        <footer class="footer">

            <h2>Connect with Us </h2>
            <p>GameRank is your go-to destination for ranking, rating, and awarding the best video games of the year.
                Discover
                top-rated games, vote for your favorites, and explore the winners of the annual GameRank Awards. Whether
                you're a casual
                gamer or a hardcore fan, GameRank celebrates the creativity, gameplay, and impact of the gaming world.
            </p>
            <div class="box">

                <ul>
                    <li><button class="btn-W" on onclick="window.location.href='ContactUs.html'">Mail us! 📧</button>
                    </li>

                    </li>
                </ul>


            </div>
    </div>

    </footer>
</body>

</html>