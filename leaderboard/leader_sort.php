<?php
include "../game/player_class.php";
include "../database/db_connect.php";


if (isset($_POST["desc_win"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY win DESC LIMIT 3";
}
if (isset($_POST["asc_win"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY win ASC LIMIT 3";
}
if (isset($_POST["asc_time"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY total_time ASC LIMIT 3";
}
if (isset($_POST["desc_time"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY total_time DESC LIMIT 3";
}
if (isset($_POST["asc_game"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY total_games ASC LIMIT 3";
}
if (isset($_POST["desc_game"])) {
	$sql = "SELECT username, win, lose, draw, total_games, total_time FROM player_tbl ORDER BY total_games DESC LIMIT 3";
}

$result = $conn->query($sql);
   
$i=0;
$leaders_arr= Array();
//if row exists from query, get it and assign row's col-name 
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$newPlayer = new Player();
	$newPlayer->username=($row["username"]);
	$newPlayer->win=($row["win"]);
	$newPlayer->lose=($row["lose"]);
	$newPlayer->draw=($row["draw"]);
	$newPlayer->total_games=($row["total_games"]);
	$newPlayer->total_time=($row["total_time"]);
	$leaders_arr[$i]=$newPlayer;
	$i+=1;
	}
	$leaders = json_encode($leaders_arr);
	echo $leaders;
}else {
	$bad1=[ 'bad' => 1];
	
	echo json_encode($bad1);	
}

$conn->close();

?>
