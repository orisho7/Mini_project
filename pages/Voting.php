<?php
// Include the connection
include("../includes/count.php");
include("../includes/import_games.php");
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.php"); // Redirect to login page
    exit();
}


?>

<html>

<head>
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Optimized Google Fonts loading -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" media="print"
        onload="this.media='all'">

    <!-- Fallback in case JavaScript is disabled -->
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap">
    </noscript>

    <link rel="mark" href="">
    <link rel="stylesheet" href="../assets/css/voting.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="content">
        <button class="btn-reset" onclick="reset()"> Reset</button>
        <div class="cards">
            <?php foreach ($games as $game): ?>
                <div class="cardo">
                    <img loading="lazy" class="photoG" src="<?php echo $game['game_url']; ?>" alt="">
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
        <button class="btn-winner" onclick="window.location.href='../pages/Awards.php'">See the winner</button>




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
<div id="navbar"></div>

<script>
    fetch('../includes/navbar.php')
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
        votedGames.push({
            id: gameId,
            name: gameName
        });

        fetch("../includes/count.php", {
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

    }
</script>
<script>
    function reset() {
        // Make an AJAX call to a PHP reset script
        fetch("../includes/reset.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Reset the UI
                    hasVoted = false;
                    votedGames = [];

                    // Re-enable all vote buttons
                    const voteButtons = document.querySelectorAll('.btn-donate');
                    voteButtons.forEach(button => {
                        button.disabled = false;
                        button.textContent = "Vote now";
                    });

                    alert("Your votes have been reset!");
                    // Optionally refresh the page
                    location.reload();
                } else {
                    alert("Error resetting votes: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Reset completed.');
            });
    }
    // Check if user has already voted when page loads
    window.onload = function () {

        // Disable all vote buttons and update their text

        if (hasVoted == true) {
            const voteButtons = document.querySelectorAll('.btn-donate');
            voteButtons.forEach(button => {
                button.disabled = true;
                button.textContent = "Already Voted";
            });
        }

    }
</script>