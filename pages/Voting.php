<?php
// Include the connection
include("../includes/count.php");
include("../includes/import_games.php");
include("../includes/gameo.php");
include("../includes/profile_popup.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.php"); // Redirect to login page
    exit();
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="../assets/js/navbar.js"></script>
</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="../assets/photos/27669-365224683_small.mp4" type="video/mp4">
    </video>
    <div class="Vcontent">
      
        <button id="reset" class="btn-reset" onclick="reset()"> Reset</button>
        <div class="cards">
            <?php foreach ($games as $game): ?>
                <div class="cardo">
                    <img loading="lazy" class="photoG" src="<?php echo $game['game_url']; ?>" alt="">
                    <div class="card-content">
                        <p class="name"><?php echo $game['game_name']; ?></p>
                        <!-- Add description here if you have one -->
                    </div>
                    <div class="btn-container">
                        <button
                            onclick="addScore('<?php echo $game['game_id']; ?>', '<?php echo $game['game_name']; ?>', this)"
                            class="btn-donate">Vote now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
        <button class="btn-winner" onclick="window.location.href='../pages/Awards.php'">See the winner</button>

        <?php include("../includes/footer.php"); ?>

<?php include("../includes/navbar.php"); ?>
<script>

    fetch('../includes/navbar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('navbar').innerHTML = data;
        });

</script>

    <script>  document.addEventListener('DOMContentLoaded', function () {
        // Wait a bit if navbar is loaded via fetch
        setTimeout(function () {
            var navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', function () {
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
    if (!hasVoted) {
        document.getElementById('reset').style.display = 'none';

    }


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
                        location.reload();

                    });

                } else {
                    alert("Error resetting votes: " + data.message);
                    location.reload();

                }
            })
            .catch(error => {
                console.error('Error:', error);
                location.reload();

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