<?php
include "create_player_class.php";
// Get inputs from form post to create classes
if (isset($_POST['p1_color'])){$p1_color = $_POST['p1_color'];}
if (isset($_POST['p2_color'])){$p2_color = $_POST['p2_color'];}
if (isset($_POST['board_color'])){$board_color = $_POST['board_color'];}
if (isset($_POST['board_size'])){$board_size = $_POST['board_size'];}
// echo 'player1:' . $p1_color . '</br>player2:' . $p2_color . 
// '</br>board color:'. $board_color . '</br>board_size: '. $board_size ;

//create player classes

$player1 = new Player();
$player1->user_name;
$player1->password;
$player1->user_id;
$player1->chip_color = $p1_color;
$player1->hints;
$player1->stats;
$player_json1 = json_encode($player1);

$player2 = new Player();
$player2->user_name;
$player2->password;
$player2->user_id;
$player2->chip_color = $p2_color;
$player2->hints;
$player2->stats;
$player_json2 = json_encode($player2);
echo "New records:<br> ". $player_json1."<br>". $player_json2 ."<br>created successfully<br>";
 



// header("Location: http://localhost/CSCI-130-Connect-4/board_chip.html");
?>