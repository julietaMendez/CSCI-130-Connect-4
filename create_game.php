<?php
include "player_class.php";
include "board_class.php";
// Get inputs from form post to create classes
if (isset($_POST['p1_color'])){$p1_color = $_POST['p1_color'];}
if (isset($_POST['p2_color'])){$p2_color = $_POST['p2_color'];}
if (isset($_POST['board_color'])){$board_color = $_POST['board_color'];}
if (isset($_POST['board_size'])){$board_size = $_POST['board_size'];}
// echo 'player1:' . $p1_color . '</br>player2:' . $p2_color . 
// '</br>board color:'. $board_color . '</br>board_size: '. $board_size ;

//create player instances
$player1 = new Player();
$player1->user_name = "player1";
$player1->password;
$player1->user_id;
$player1->chip_color = $p1_color;
$player1->hints;
$player1->wins;
$player1->total_games;
$player1->total_time;
$player_json1 = json_encode($player1);

$player2 = new Player();
$player2->user_name = "player2";
$player2->password;
$player2->user_id;
$player2->chip_color = $p2_color;
$player2->hints;
$player2->wins;
$player2->total_games;
$player2->total_time;
$player_json2 = json_encode($player2);

//create board instance
$board = new Board();
$board->board_width = $board_size[0];
$board->board_height = $board_size[2];
$board->board_color = $board_color;
$board->curr_player = 1;
$board->turns = 0;
$board->time_elapse = 0;
$board->empty_spaces = 0;
$board_json = json_encode($board);


echo "New records:<br> ". $player_json1."<br>". $player_json2 ."<br>".$board_json."created successfully<br>";
 



// header("Location: http://localhost/CSCI-130-Connect-4/board_chip.html");
?>