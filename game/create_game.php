<?php
include "player_class.php";
include "board_class.php";
include "../database/db_connect.php";
require "../database/header.php";

// Get inputs from form post to create classes
if (isset($_POST['p1_color'])){$p1_color = $_POST['p1_color'];}
if (isset($_POST['p2_color'])){$p2_color = $_POST['p2_color'];}
if (isset($_POST['board_color'])){$board_color = $_POST['board_color'];}
if (isset($_POST['board_size'])){$board_size = $_POST['board_size'];}

// create player instances
$player1 = new Player();
$player1->username = $_SESSION['username'];
$player1->chip_color = $p1_color;
$player1->hints;
$player1->win = $_SESSION['win'];
$player1->lose = $_SESSION['lose'];
$player1->draw = $_SESSION['draw'];
$player1->total_games = $_SESSION['total_games'];
$player1->total_time = $_SESSION['total_time'];
$player1_json = json_encode($player1);

// create opponent player class
$player2 = new Player();
$player2->username = "Worthy Competitor";
$player2->chip_color = $p2_color;
$player2->hints;
$player2_json = json_encode($player2);

//create board instance
$board = new Board();
$board->board_width = $board_size[0];
$board->board_height = $board_size[2];
$board->board_color = $board_color;
$board->curr_player = 1;
$board->turns = 0;
$board->time_elapse = 0;
$board->empty_spaces = $board_size[0]*$board_size[2];
$board_json = json_encode($board);

$_SESSION["player1"]=$player1_json;
$_SESSION["player2"]=$player2_json;
$_SESSION["board"]=$board_json;

echo "New records:<br> ". $player1_json."<br>". $player2_json ."<br>".$board_json."created successfully<br>";

header("Location: http://localhost/CSCI-130-Connect-4/game/connect4.php");
?>