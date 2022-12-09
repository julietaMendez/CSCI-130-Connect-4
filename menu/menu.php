
<?php
require "../database/header.php";
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="menu.css"></head>

<body>
    <div id="welcome">
    <h1>Welcome, <b><?php echo $_SESSION['username']; ?></b></h1>
    </div>
    <section id="menu">
        <div id="navigate">
            <a  href="../game/game_options.php">Play Connect 4</a>
        </div>
        <div id="navigate">
            <a href="../menu/help.php">Instructions</a>
        </div>
        <div id="navigate">
            <a href="../leaderboard/leaderboard_page.php">Leaderboard</a>
        </div>
        <div id="navigate">
            <a href="../menu/contact_us.php">Contact Us</a>
        </div>
        <div id="navigate">
            <a href="../login/logout.php">Log Out</a>
        </div>
    </section>
</body>
</html>