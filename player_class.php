<?php
class Player implements JsonSerializable{
    public $user_name;
    public $password;
    public $user_id;
    public $chip_color;
    public $hints;
    public $wins;
    public $total_games;
    public $total_time;

    public function __construct(){
        $this->user_name = generateRandomString();
        $this->password = generateRandomString();
        $this->user_id = generateRandomString();
        $this->chip_color = strval(10);
        $this->hints = [];
        $this->wins = 0;
        $this->total_games = 0;
        $this->total_time = 0;
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'user_name' => $this->user_name,
            'password' => $this->password,
            'user_id' => $this->user_id,
            'chip_color' => $this->chip_color,
            'hints' => $this->hints,
            'wins' => $this->wins,
            'total_games' => $this->total_games,
            'total_time' => $this->total_time
            ];
    }
    
    // std obj -> movie Object
    public function Set($json){
        $this->user_name = $json['user_name'];
        $this->password = $json['password'];
        $this->user_id = $json['user_id'];
        $this->chip_color = $json['chip_color'];
        $this->hints = $json['hints'];
        $this->wins = $json['wins'];
        $this->total_games = $json['total_games'];
        $this->total_time = $json['total_time'];
    }

    public function Display() {
        $v=json_encode($this);
        echo $v;
    }
    
    public function GetString() {
        return json_encode($this);
    }
}

function generateRandomString($length = 5) {
	// list of characters that can be present in the string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>