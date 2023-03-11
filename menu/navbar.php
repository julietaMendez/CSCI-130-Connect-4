<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../menu/menu.css" />
  </head>

  <body>
    <div class="topnav">
      <div class="nav_split">
        <a href="../game/game_options.php">Play</a>
        <a href="../menu/help.php">Instructions</a>
        <a href="../leaderboard/leaderboard_page.php">Leaderboard</a>
        <a href="../menu/contact_us.php">Contact Us</a>
        <a href="../login/logout.php">Logout</a>
      </div>

      <div class="nav_split">
        <p id="username"><b><?php echo $_SESSION['username']; ?></b></p>
      </div>
    </div>

  </body>
</html>
