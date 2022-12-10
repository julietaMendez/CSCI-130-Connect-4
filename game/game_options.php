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
        <h1>Game Options</h1>
        <form class="options" width="100%" action="create_game.php" method="POST">
            <!-- Player 1 Chooses Color -->
            <fieldset>
                <h2>Player 1, pick your color</h2>
                <div>
                    <input type=button class="chip-btn red" id="p1_red" value="red" onclick="set_chip_color_p1(this.value)">
                    <input type=button class="chip-btn skyblue" id="p1_skyblue" value="skyblue" onclick="set_chip_color_p1(this.value)">
                    <input type=button class="chip-btn yellow" id="p1_yellow" value="yellow" onclick="set_chip_color_p1(this.value)">
                    <input type=button class="chip-btn dullpink" id="p1_dullpink" value="dullpink" onclick="set_chip_color_p1(this.value)">
                    <h3>Player 1 Color: </h3>
                </div>
                <div><input type="text" id="p1_color" name="p1_color" value="red" ></div>
                
            </fieldset>

            <!-- Player 2 Chooses Color -->
            <fieldset>
            <h2>Player 2, pick your color</h2>
                <div><input type=button class="chip-btn red" id="p2_red" value="red" onclick="set_chip_color_p2(this.value)">
                    <input type=button class="chip-btn skyblue" id="p2_skyblue" value="skyblue" onclick="set_chip_color_p2(this.value)">
                    <input type=button class="chip-btn yellow" id="p2_yellow" value="yellow" onclick="set_chip_color_p2(this.value)">
                    <input type=button class="chip-btn chosen dullpink" id="p2_dullpink" value="dullpink" onclick="set_chip_color_p2(this.value)">
                    <h3>Player 2 Color: </h3>
                </div>
                <div><input type="text" id="p2_color" name="p2_color" value="yellow"></div>
            </fieldset>

            <!-- Choose Board Color & Size -->
            <fieldset>
            <h2>Choose a board color: </h2>
            <div>
                <input type=button class="blue btn" id="board_blue" value="blue" onclick="set_board_color(this.value)">
                <input type=button class="green btn" id="board_green" value="green" onclick="set_board_color(this.value)">
                <input type=button class="pink btn" id="board_pink" value="pink" onclick="set_board_color(this.value)">
                <input type=button class="purple btn" id="board_purple" value="purple" onclick="set_board_color(this.value)">
            </div>
                <input type="text" id="board_color" name="board_color" value="blue">
               <h2>Choose board size: </h2>
            <div>
                <input type="button" class="red btn" id="6x7" value="7x6" onclick="set_tbl_size(7,6)">
                <input type="button" class="blue btn" id="8x9" value="9x8" onclick="set_tbl_size(9,8)">
                <input type="text" id="board_size" name="board_size" value="6x7">   
            </div>
            </fieldset>
            <input type="submit" class="start btn" value="Start Game" id="start_btn">
        </form>
    
        <script src="game_options.js"></script>
    </body>
</html>