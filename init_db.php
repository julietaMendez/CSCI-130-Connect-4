<?php
include "player_class.php";
$servername = "localhost"; // default server name
$username = "connect4"; // user name that you created
$password = "connect4pass"; // password that you created
$dbname = "connect4_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

// Create the database
// $sql = "CREATE DATABASE ". $dbname;
// if ($conn->query($sql) === TRUE) {
//     echo "Database ". $dbname ." created successfully<br>";
// } else {
//     echo "Error creating database: " . $conn->error ."<br>";
// }

// close the connection
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//create str to create table w/col headers
$sql = "CREATE TABLE player_tbl (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_name  VARCHAR(30) NOT NULL,
user_id   VARCHAR(30) NOT NULL,
chip_color   VARCHAR(30) NOT NULL,
hints  VARCHAR(30) NOT NULL,
wins INT(4) NOT NULL,
total_games INT(4) NOT NULL,
total_time VARCHAR(30) NOT NULL)";


// confirm table creation
if ($conn->query($sql) === TRUE) {
    echo "Table Person created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}


// create column headers
$stmt = $conn->prepare("INSERT INTO player_tbl (user_name, user_id, chip_color, hints, wins, total_games, total_time) VALUES (?,?,?,?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
// bind parameters
$stmt->bind_param("ssssiis", $user_name, $user_id, $chip_color, $hints, $wins, $total_games, $total_time);
//create player instances
$player1 = new Player();
$user_name = $player1->user_name;
$password = $player1->password;
$user_id = $player1->user_id;
$chip_color = $player1->chip_color;
$hints = $player1->hints;
$wins = $player1->wins;
$total_games = $player1->total_games;
$total_time = $player1->total_time;
$stmt->execute();

$player2 = new Player();
$user_name = $player2->user_name;
$password = $player2->password;
$user_id = $player2->user_id;
$chip_color = $player2->chip_color;
$hints = $player2->hints;
$wins = $player2->wins;
$total_games = $player2->total_games;
$total_time = $player2->total_time;
$stmt->execute();
$stmt->close();

// close the connection
$conn->close();


?>
