
<?php 
require "../database/header.php";
include "../menu/navbar.php";
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="menu.css"><head>

<body>
    <!-- <div class="topnav">
        <a href="../connect4.php">Play</a>
        <a class="active" href="help.html">Instructions</a>
        <a href="../leaderboard/leaderboard_page.php">Leaderboard</a>
        <a href="contact_us.html">Contact Us</a>
    </div>  -->

    <h1>How To Play Connect 4</h1>

    <div id="instructions">
        <h2>Instructions</h2>
        <p>Connect 4 is a two player game in which the players alternate 
            placing their respective chips on the board until either 
            <ol>
            <li>someone wins by placing 4 chips in a row</li>
            <li>they reach a draw (no more chips can be placed on the board)</li>
            </ol> 
        </p> 
    <img src="../img/wins.png" alt="Examples of wins img" class="center">
        
    <h2>Tips</h2>
    <ol>
    <li>The first player has more opportunities to win by placing their chip in the center.</li>
    <li>Block your opponent from making more than 2-in-a-row.</li>
    <li>Gaurantee a win by setting up two win conditions stacked on top of each other!</li>
    </ol>

    <img src="../img/win_ex.png" alt="Example of stacked wins img" width="450" height="400" class="center">  
    </div>
</body>
</html>
