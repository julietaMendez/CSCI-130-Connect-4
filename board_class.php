<?php
class Board implements JsonSerializable{
    public $board_width;
    public $board_height;
    public $board_color;
    public $curr_player;
    public $turns;
    public $time_elapse;
    public $empty_spaces;

    public function __construct(){
        $this->board_width;
        $this->board_height;
        $this->board_color;
        $this->curr_player;
        $this->turns;
        $this->time_elapse;
        $this->empty_spaces;
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'board_width' => $this->board_width,
            'board_height' => $this->board_height,
            'board_color' => $this->board_color,
            'curr_player' => $this->curr_player,
            'turns' => $this->turns,
            'time_elapse' => $this->time_elapse,
            'empty_spaces' => $this->empty_spaces
            ];
    }
    
    // std obj -> movie Object
    public function Set($json){
        $this->board_width = $json['board_width'];
        $this->board_height = $json['board_height'];
        $this->board_color = $json['board_color'];
        $this->curr_player = $json['curr_player'];
        $this->turns = $json['turns'];
        $this->time_elapse = $json['time_elapse'];
        $this->empty_spaces = $json['empty_spaces'];
    }

    public function Display() {
        $v=json_encode($this);
        echo $v;
    }
    
    public function GetString() {
        return json_encode($this);
    }
}

?>