<?php
require "../database/header.php";
include "../menu/navbar.php";

?>
<!-- The players will choose their board size and chip colors here, then navigate to the board game page -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="chip.css">
    </head>
    <body>
        <header>
        </header>
        <form class="options" width="100%" action="create_game.php" method="POST">
            <fieldset>
                <input type=button class="red" id="p1_red" value="red" onclick="set_chip_color_p1(this.value)">
                <input type=button class="skyblue" id="p1_skyblue" value="skyblue" onclick="set_chip_color_p1(this.value)">
                <input type=button class="yellow" id="p1_yellow" value="yellow" onclick="set_chip_color_p1(this.value)">
                <input type=button class="dullpink" id="p1_dullpink" value="dullpink" onclick="set_chip_color_p1(this.value)">
                <h2>Player 1 Color: </h2>
                <input type="text" id="p1_color" name="p1_color" value="red" >
            </fieldset>
            <fieldset>
                <input type=button class="red" id="p2_red" value="red" onclick="set_chip_color_p2(this.value)">
                <input type=button class="skyblue" id="p2_skyblue" value="skyblue" onclick="set_chip_color_p2(this.value)">
                <input type=button class="yellow" id="p2_yellow" value="yellow" onclick="set_chip_color_p2(this.value)">
                <input type=button class="dullpink" id="p2_dullpink" value="dullpink" onclick="set_chip_color_p2(this.value)">
                <h2>Player 2 Color: </h2>
                <input type="text" id="p2_color" name="p2_color" value="yellow" >
            </fieldset>
            <fieldset>
                <input type=button class="blue" id="board_blue" value="blue" onclick="set_board_color(this.value)">
                <input type=button class="green" id="board_green" value="green" onclick="set_board_color(this.value)">
                <input type=button class="pink" id="board_pink" value="pink" onclick="set_board_color(this.value)">
                <input type=button class="purple" id="board_purple" value="purple" onclick="set_board_color(this.value)">
                <h2>Choose a board color: </h2>
                <input type="text" id="board_color" name="board_color" value="blue" >
                <h2>Choose board size: </h2>
                <input type="button" id="6x7" value="6x7" onclick="set_tbl_size(6,7)">
                <input type="button" id="8x9" value="8x9" onclick="set_tbl_size(8,9)"><br>
                <input type="text" id="board_size" name="board_size" value="6x7">
            </fieldset>
            <input type="submit" value="Start Game" id="start_btn">
        </form>
    
        <script src="game_options.js"></script>
    </body>
</html>