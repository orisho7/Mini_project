<?php
include("count.php");
?>
<html>

<head>
    <link rel="mark" href="">
    <link rel="stylesheet" href="voting.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <div id="navbar"></div>

    <script>
        fetch('navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar').innerHTML = data;
            });
        let score = 0;


        function addScore(gameName, buttonElement) {
            if (score == 0) {
                score += 1;
                buttonElement.textContent = "✓ Voted";
                buttonElement.style.backgroundColor = "#4CAF50"; // Green color
                buttonElement.disabled = true;
            }
            document.getElementById("score").textContent = score;

            // Send the score and game name to PHP
            fetch("count.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "score=" + score + "&game=" + encodeURIComponent(gameName)
            });
        }
    </script>



</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="content">
        <div class="cards">
            <div class="cardo">
                <img class="photoG"
                    src="photos/rocket_league__2015__folder_icon_v2_by_foldericonboy_djculhc-375w-2x_2.png" alt="">
                <p class="name">Rocket League</p>
                <div>
                    <p class="catog">Sports</p>
                    <p class="catog">Race</p>
                    <h2>Score: <span id="score">0</span></h2>

                </div>
                <button onclick="addScore('Rocket League' , this)" class="btn-donate">Vote now</button>
            </div>
            <div class="cardo">
                <img class="photoG"
                    src="photos/rocket_league__2015__folder_icon_v2_by_foldericonboy_djculhc-375w-2x_2.png" alt="">
                <p class="name">Rocket League</p>
                <div>
                    <p class="catog">Sports</p>
                    <p class="catog">Race</p>
                </div>
                <button onclick="addScore('CyberPunk' , this)" class="btn-donate" id="vote">Vote now</button>

            </div>
        </div>




        <div class="footer_container">
            <footer class="footer">

                <h2>Connect with Us </h2>
                <p>GameRank is your go-to destination for ranking, rating, and awarding the best video games of the
                    year.
                    Discover
                    top-rated games, vote for your favorites, and explore the winners of the annual GameRank Awards.
                    Whether
                    you're a casual
                    gamer or a hardcore fan, GameRank celebrates the creativity, gameplay, and impact of the gaming
                    world.
                </p>
                <div class="box">

                    <ul>
                        <li><button class="btn-W" on onclick="window.location.href='ContactUs.html'"><b><i
                                        class="bi bi-whatsapp"></i></b> </button></li>
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
    </div>
    </div>
</body>

</html>