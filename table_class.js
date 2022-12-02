// Create the table
var tbl = document.getElementById("connect_4_table");
var colArr = createColArr(max_col);
var max_col;
var max_row;
//var player1_color;
//var player2_color;
var board_color;
var player_id = 1;
var curr_player = document.getElementById("curr_player");

function createColArr(max_col) {
  var arr = new Array(); //keep track of spots taken within col at index i
  for (i = 0; i < max_col; i++) {
    arr[i] = 0;
  }
  return arr;
}

function create_tbl() {
  player1_color = document.getElementById("p1_color").innerText;
  player2_color = document.getElementById("p2_color").innerText;
  console.log(player1_color);

  let size_str = document.getElementById("board_size").innerText;
  board_color = document.getElementById("board_color").innerText;
  // slice the string to get the board size
  max_col = size_str.slice(0, 1);
  max_row = size_str.slice(2);

  clear_tbl();
  //add rows to tbl
  for (i = 0; i < max_row; i++) {
    let row = tbl.insertRow();
    // add cols to tbl. The cols have unique id's that reflect their location
    for (j = 0; j < max_col; j++) {
      let cell = row.insertCell();
      cell.setAttribute("id", i + "_" + j);
      cell.setAttribute("onclick", "place_chip(this.id)");
      cell.innerHTML = "<div class='empty_space'></div>";
      cell.classList.add(board_color);
      cell.setAttribute("onmouseover", "shade_col(this.id)");
      cell.setAttribute("onmouseout", "normal_col(this.id)");
    }
    //tbl.border="solid 10px black";
    tbl.style.borderCollapse = "collapse";
  }
  update_curr_player();
}

//get the cell id and then find entire col
function shade_col(id) {
  // onmouseover: on hover
  let col = id.slice(2);
  let shade_space = find_space(col, colArr[col]);
  let next_place = document.getElementById(shade_space + "_" + col);
  // darken the column up to the next available space
  for (row = 0; row < shade_space; row++) {
    let cell = document.getElementById(row + "_" + col);
    cell.classList.add("darken");
  }
  // find the spot to highlight
  next_place.classList.add("hilight");
}

function normal_col(id) {
  // onmouseout: not on hover
  let col = id.slice(2);
  for (row = 0; row < max_row; row++) {
    let cell = document.getElementById(row + "_" + col);
    cell.classList.remove("darken");
    cell.classList.remove("hilight");
  }
}

function clear_tbl() {
  colArr = []; //reset the array for a new board
  for (i = 0; i < max_col; i++) {
    colArr[i] = 0;
  }
  tbl.innerHTML = "";
}

function find_space(curr_col, num_chips_in_col) {
  space_avail = 0;
  if (num_chips_in_col <= max_row) {
    // valid placement
    space_avail = max_row - (num_chips_in_col + 1); // calculates first available placement
  }
  return space_avail; // returns index of row to place chip
}

function place_chip(id) {
  let curr_col = id.slice(2);
  let curr_row = id.slice(-1);
  let num_chips_in_col = colArr[curr_col];
  let space_avail = find_space(curr_col, num_chips_in_col);
  colArr[curr_col] += 1;

  // update div to put chip in place
  let chip = document.getElementById(space_avail + "_" + curr_col);
  if (player_id == 0) {
    str = `<div class='chip${player_id} ${player1_color}'></div>`;
  } else {
    str = `<div class='chip${player_id} ${player2_color}'></div>`;
  }

  chip.innerHTML = str;
  update_curr_player();
  
}

//updates curr player display
function update_curr_player(){
  p1_name = document.getElementById("p1_name").innerText;
  p2_name = document.getElementById("p2_name").innerText;
  if (player_id == 1) {
    curr_player.innerHTML = p1_name;
    curr_player.classList = "";
    curr_player.classList.add(player1_color);
  } else {
    curr_player.innerHTML = p2_name;
    curr_player.classList = "";
    curr_player.classList.add(player2_color);
  }
  // ternary to alternate players
  player_id == 1 ? (player_id = 0) : (player_id = 1);
}


// these are to select and display colors in the game options page
function set_chip_color_p1(input_color) {
  //p1 cannot choose the same color as p2
  if (player2_color != input_color) {
    player1_color = input_color; // keep track
    p1_color_display = document.getElementById("p1_color"); // get the display
    p1_color_display.value = input_color; // set the display

    let p1 = document.getElementById("p1_color");
    player1_color = color;
    p1.value = player1_color;
    let curr_p = document.getElementById("curr_player");
    curr_p.innerHTML = player1_color;
  }
}

function set_chip_color_p2(input_color) {
  //p2 cannot choose the same color as p1
  if (player1_color != input_color) {
    player2_color = input_color; // keep track
    p2_color_display = document.getElementById("p2_color"); // get the display
    p2_color_display.value = input_color; // set the display
  }

  if (player1_color != color) {
    let p2 = document.getElementById("p2_color");
    player2_color = color;
    p2.innerHTML = player2_color;
  }
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

create_tbl();
