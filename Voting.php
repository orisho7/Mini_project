<?php
// Include the connection
include("count.php");
include("import_games.php");
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}


$username = $_SESSION['username'];
$voted_games = [];
$query_votes = "SELECT v.game_id, g.game_name FROM votes v JOIN games g ON v.game_id = g.game_id WHERE v.username = '$username'";
$result_votes = mysqli_query($conn, $query_votes);

while ($row = mysqli_fetch_assoc($result_votes)) {

    $voted_games[] = ['id' => $row['game_id'], 'name' => $row['game_name']];
}
$voted_games_json = json_encode($voted_games);
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
    </script>
    <script>
        let score = 0;
        let votedGames = <?php echo $voted_games_json; ?>;
        let hasVoted = votedGames.length > 0;

        function hasVotedForGame(gameId) {
            return votedGames.some(game => game.id === gameId);
        }


        function addScore(gameId, gameName, buttonElement) {
            if (hasVoted) {
                alert("You already voted!");
                return;
            }
            score += 1;
            buttonElement.textContent = "✓ Voted";
            buttonElement.disabled = true;
            hasVoted = true;
            votedGames.push({ id: gameId, name: gameName });

            fetch("count.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "score=" + score + "&game_id=" + gameId + "&game_name=" + encodeURIComponent(gameName)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting your vote.');
                });
        }

    </script>
    <script>
        // Check if user has already voted when page loads
        window.onload = function () {

            // Disable all vote buttons and update their text

            if (hasVoted) {
                const voteButtons = document.querySelectorAll('.btn-donate');
                voteButtons.forEach(button => {
                    button.disabled = true;
                    button.textContent = "Already Voted";
                });
            }

        }

    </script>






</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="content">

        <div class="cards">
            <?php foreach ($games as $game): ?>
                <div class="cardo">
                    <img class="photoG" src="<?php echo $game['game_url']; ?>" alt="">
                    <p class="name"><?php echo $game['game_name']; ?></p>
                    <div>
                        <p class="catog">Sports</p>
                        <p class="catog">Race</p>
                    </div>
                    <button onclick="addScore('<?php echo $game['game_id']; ?>', '<?php echo $game['game_name']; ?>', this)"
                        class="btn-donate">Vote
                        now</button>
                </div>
            <?php endforeach; ?>
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