<?php if (isset($_SESSION['username'])): ?>
    <?php include("../includes/gameo.php"); ?>
    <script src="../assets/js/navbar.js">
        popup();
        closePopup();
        </script>

    
    <div id="overlay" class="overlay" onclick="closePopup()"></div>
    <div id="box" class="box">

                <h1 style="color: white;">Username: <?php echo $username; ?></h1>
                <?php if ($game_urlvoted != ""): ?>
                <h1 style="color: white;">You have already voted for</h1>
                <img class="user_voted" src="<?php echo $game_urlvoted; ?>" alt="">
                <?php endif; ?>
                <button class="close_button" onclick="closePopup()">Close</button>
                <button class = "delete_account" onclick="deleteAccount()">Delete Account</button>
                
            </div>
            
<?php endif; ?>
