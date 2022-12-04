<?php
require "../database/header.php";
include "../menu/navbar.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="chip.css">
    </head>
    <body>
        <div class="select_options">
            <form>
                <fieldset>
                <!-- <h1>Welcome, <b> <?php echo $_SESSION['username']; ?></b></h1> -->
                    <a href="/CSCI-130-CONNECT-4/game/game_options.php">Return To Game Options</a>      
                    <a href="/CSCI-130-CONNECT-4/game/connect4.php">Restart</a>   

                    <div id = "board_size">
                        <?php $decode = json_decode($_SESSION["board"]); 
                        $board_width = $decode->board_width;
                        $board_height = $decode->board_height;
                        echo $board_width."x".$board_height;
                        ?>
                    </div>
                    
                    <div id = "board_color">
                        <?php $decode = json_decode($_SESSION["board"]); 
                        $board_color = $decode->board_color;
                        echo $board_color;
                        ?>
                    </div>
 
                </fieldset>
            </form>
        
            <div class="display">
                <!-- popup screens  -->
              
                <div id="draw_popup" class="hidden"> </div>
                <div id="win_popup" class="hidden"> </div>

                <!-- player 1 Info -->
                <h2 id="p1_name"><?php echo $_SESSION['username'];?></h2>
                <p id="p1_color"><?php echo json_decode($_SESSION["player1"])->chip_color; ?> </p>
                <p>Wins: <?php echo json_decode($_SESSION["player1"])->win; ?></p>
                <p>Losses: <?php echo json_decode($_SESSION["player1"])->lose; ?></p>
                <p>Draws: <?php echo json_decode($_SESSION["player1"])->draw; ?></p>
                <p id="p1_3_in_a_row">3 In A Rows: 0</p>
               
                <!-- Player 2 Info -->
                <h2 id="p2_name"><?php echo json_decode($_SESSION["player2"])->username?></h2>
                <p id="p2_color"><?php echo json_decode($_SESSION["player2"])->chip_color; ?> </p>
                <p id="p2_3_in_a_row">3 In A Rows: 0</p>

                <h2>Current player: </h2>
                <p id="curr_player"><?php echo $_SESSION['username'];?></p>

                <h2>Remaining Turns:</h2>
                <p id="empties"><?php echo json_decode($_SESSION["board"])->empty_spaces?></p>
           
            </div>

            <table id="connect_4_table"></table>

            <div id="display"></div>
        
        
        <script src="connect4.js"></script>
    </body>
</html>
