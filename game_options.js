var player1_color;
var player2_color;
var board_color;

var curr_player = document.getElementById("curr_player");

// these are to select and display colors in the game options page
function set_chip_color_p1(input_color) {
  //p1 cannot choose the same color as p2
  player2_color = document.getElementById("p2_color").value;
  if (player2_color != input_color) {
    player1_color = input_color; // keep track
    p1_color_display = document.getElementById("p1_color"); // get the display
    p1_color_display.value = input_color; // set the display

    // let p1 = document.getElementById("p1_color");
    // player1_color = color;
    // p1.value = player1_color;
    // let curr_p = document.getElementById("curr_player");
    // curr_p.innerHTML = player1_color;
  }
}

function set_chip_color_p2(input_color) {
  //p2 cannot choose the same color as p1
  player1_color = document.getElementById("p1_color").value;
  if (player1_color != input_color) {
    player2_color = input_color; // keep track
    p2_color_display = document.getElementById("p2_color"); // get the display
    p2_color_display.value = input_color; // set the display
  }

  // if (player1_color != color) {
  //   let p2 = document.getElementById("p2_color");
  //   player2_color = color;
  //   p2.innerHTML = player2_color;
  // }
}

function set_board_color(input_color) {
  if (input_color != player1_color && input_color != player2_color) {
    let board_color_display = document.getElementById("board_color");
    board_color_display.value = input_color;
  }
}

function set_tbl_size(row, col) {
  let board_display = document.getElementById("board_size");
  board_display.value = row + "x" + col;
}


