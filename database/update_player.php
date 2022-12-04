<?php 
include "../database/db_connect.php";
include "../database/db_credentials.ini";

if (isset($_POST["gameover"])){ 
    if (isset($_POST["username"])){ $username = $_POST["username"]; echo 'username '. $username;}
    if (isset($_POST["total_time"])){ $game_time = $_POST["total_time"];echo 'game_time '. $game_time;}

    $sql = "SELECT * FROM player_tbl WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $win=($row["win"]);
            $lose=($row["lose"]);
            $draw=($row["draw"]);
            $total_games=($row["total_games"]);
            $total_time=($row["total_time"]);
        }
    }else {
        $bad1=[ 'bad' => 1];
        echo $bad1;
    }
    $conn->close();

    // reconnect ---------------------------------------------
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 


    if($_POST["gameover"]=="win"){
        $sql = "UPDATE player_tbl SET win ='$win'+1, total_games='$total_games'+1, total_time='$total_time'+'$game_time' WHERE username = '$username'";
    }
    
    if($_POST["gameover"]=="lose"){
        $sql = "UPDATE player_tbl SET lose ='$lose'+1, total_games='$total_games'+1, total_time='$total_time'+'$game_time' WHERE username = '$username'";
    }
    
    if($_POST["gameover"]=="draw"){
        $sql = "UPDATE player_tbl SET draw ='$draw'+1, total_games='$total_games'+1, total_time='$total_time'+'$game_time' WHERE username = '$username'";
    }
    
    
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo $username . " record updated successfully";
    } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>