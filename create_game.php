<?php
if (isset($_POST['p1_color'])){$p1_color = $_POST['p1_color'];}
if (isset($_POST['p2_color'])){$p2_color = $_POST['p2_color'];}
if (isset($_POST['board_color'])){$board_color = $_POST['board_color'];}
if (isset($_POST['board_size'])){$board_size = $_POST['board_size'];}
echo 'player1:' . $p1_color . '</br>player2:' . $p2_color . 
'</br>board color:'. $board_color . '</br>board_size: '. $board_size ;

//create player classes
// header("Location: http://localhost/CSCI-130-Connect-4/board_chip.html");
?>