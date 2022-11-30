<?php
session_start();
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
                <a href="game_options.php">Go back</a>

                <label for="choose_size">Choose board size: </label>
                <input type="button" name=choose_size id="tbl6_7" value="6x7" onclick="create_tbl(this.id)">
                <input type="button" name=choose_size id="tbl8_9" value="8x9" onclick="create_tbl(this.id)">            
            
                <!-- leave her for now, until colors are saved from prev page-->
                <table id="player_color_table">
                    <tr>
                        <td>Player 1, choose your color</td>
                        <td><input type=button id="red" value="red" onclick="set_chip_color_p1(this.id)">
                            <input type=button id="lightblue" value="blue" onclick="set_chip_color_p1(this.id)">
                            <input type=button id="yellow" value="yellow" onclick="set_chip_color_p1(this.id)">
                            <input type=button id="purple" value="purple" onclick="set_chip_color_p1(this.id)">
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Player 2, choose your color</td>
                        <td><input type=button id="red" value="red" onclick="set_chip_color_p2(this.id)">
                            <input type=button id="lightblue" value="blue" onclick="set_chip_color_p2(this.id)">
                            <input type=button id="yellow" value="yellow" onclick="set_chip_color_p2(this.id)">
                            <input type=button id="purple" value="purple" onclick="set_chip_color_p2(this.id)">
                        </td>
                    </tr>
                </table>
                <!-- leave her for now -->
            </fieldset>
        </form>
        </div>

        <div class="display">
        <section>  
            <h2>Player 1 Color: </h2>
            <!-- <p id="p1_color"><?php echo $_SESSION["player1.chip_color"]; ?></p> -->
            <h2>Player 2 Color: </h2>
            <p id="p2_color">yellow</p>
            <h2>Current player: </h2>
            <p id="curr_player">red</p>
        </section>
        </div>



        <table id="connect_4_table"></table>

        <div id="display">

        </div>
        
        <script src="table_class.js"></script>
    </body>
</html>

<?php
session_destroy();
?>