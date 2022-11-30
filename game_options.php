<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    session_destroy(); 
    header("Location: ./login/login_register_page.php");
    exit;
  }
?>
<!-- The players will choose their board size and chip colors here, then navigate to the board game page -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="chip.css">
    </head>
    <body>
        <header>
            <h1><?php echo $_SESSION['win']; ?></h1>
            <h1>Welcome, <b><?php echo $_SESSION['username']; ?></b></h1>
            <form width="100%" action="login/logout.php" method="POST">
                <input type="submit" value="Log out">
            </form>
        </header>
        <form class="options" width="100%" action="create_game.php" method="POST">
            <fieldset>
                <input type=button class="red" id="p1_red" value="red" onclick="set_chip_color_p1(this.value)">
                <input type=button class="blue" id="p1_blue" value="blue" onclick="set_chip_color_p1(this.value)">
                <input type=button class="yellow" id="p1_yellow" value="yellow" onclick="set_chip_color_p1(this.value)">
                <input type=button class="purple" id="p1_purple" value="purple" onclick="set_chip_color_p1(this.value)">
                <h2>Player 1 Color: </h2>
                <input type="text" id="p1_color" name="p1_color" value="red" >
            </fieldset>
            <fieldset>
                <input type=button class="red" id="p2_red" value="red" onclick="set_chip_color_p2(this.value)">
                <input type=button class="blue" id="p2_blue" value="blue" onclick="set_chip_color_p2(this.value)">
                <input type=button class="yellow" id="p2_yellow" value="yellow" onclick="set_chip_color_p2(this.value)">
                <input type=button class="purple" id="p2_purple" value="purple" onclick="set_chip_color_p2(this.value)">
                <h2>Player 2 Color: </h2>
                <input type="text" id="p2_color" name="p2_color" value="yellow" >
            </fieldset>
            <fieldset>
                <input type=button class="red" id="board_red" value="red" onclick="set_board_color(this.value)">
                <input type=button class="blue" id="board_blue" value="blue" onclick="set_board_color(this.value)">
                <input type=button class="yellow" id="board_yellow" value="yellow" onclick="set_board_color(this.value)">
                <input type=button class="purple" id="board_purple" value="purple" onclick="set_board_color(this.value)">
                <h2>Choose a board color: </h2>
                <input type="text" id="board_color" name="board_color" value="blue" >
                <h2>Choose board size: </h2>
                <input type="button" id="tbl6_7" value="6x7" onclick="set_tbl_size(this.id, this.value)">
                <input type="button" id="tbl8_9" value="8x9" onclick="set_tbl_size(this.id, this.value)"><br>
                <input type="text" id="board_size" name="board_size" value="6x7">
            </fieldset>
            <input type="submit" value="Start Game" id="start_btn">
        </form>
    
        <script src="table_class.js"></script>
    </body>
</html>