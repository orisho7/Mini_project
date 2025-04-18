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
                    <li><button class="btn-W" on onclick="window.location.href='ContactUs.html'"><b><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg></b> </button></li>
                    <li><button class="btn-X" on onclick="window.location.href='ContactUs.html'"><b><i
                                    class="bi bi-twitter-x"></i></b>
                        </button></li>
                    <li><button class="btn-E" on onclick="window.location.href='ContactUs.html'"><b><i
                                    class="bi bi-envelope-plus"></i></b>
                        </button></li>
                </ul>


            </div>
    </div>

    </footer>
</body>

</html>