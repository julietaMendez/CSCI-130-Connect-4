// table size variables
let size_str = document.getElementById("board_size").innerText;
var col_max = size_str.slice(0, 1);
var row_max = size_str.slice(2);
var tbl = document.getElementById("connect_4_table");
var colArr = createColArr(col_max); // the number of chips inside a column
var empties; // amount of empty spaces left on the board
var player_id = 1;


function createColArr(col_max) {
  var arr = new Array(); //keep track of spots taken within col at index i
  for (i = 0; i < col_max; i++) {
    arr[i] = 0;
  }
  return arr;
}

function create_tbl() {
  player1_color = document.getElementById("p1_color").innerText;
  player2_color = document.getElementById("p2_color").innerText;
  board_color = document.getElementById("board_color").innerText;
  // slice the string to get the board size

  clear_tbl();
  //add rows to tbl
  for (i = 0; i < row_max; i++) {
    let row = tbl.insertRow();
    // add cols to tbl. The cols have unique id's that reflect their location
    for (j = 0; j < col_max; j++) {
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
  if(shade_space != -1){
    let next_place = document.getElementById(shade_space + "_" + col); 
    // darken the column up to the next available space
    for (row = 0; row < shade_space; row++) {
      let cell = document.getElementById(row + "_" + col);
      cell.classList.add("darken");
    }
    // find the spot to highlight
    next_place.classList.add("hilight");
  }
}

function normal_col(id) {
  // onmouseout: not on hover
  let col = id.slice(2);
  for (row = 0; row < row_max; row++) {
    let cell = document.getElementById(row + "_" + col);
    cell.classList.remove("darken");
    cell.classList.remove("hilight");
  }
}

function clear_tbl() {
  colArr = []; //reset the array for a new board
  for (i = 0; i < col_max; i++) {
    colArr[i] = 0;
  }
  tbl.innerHTML = "";
}

function find_space(curr_col, num_chips_in_col) {
  let space_avail = 0;
  if (num_chips_in_col <= row_max) {
    // valid placement
    space_avail = row_max - (num_chips_in_col + 1); // calculates first available placement
  }
  return space_avail; // returns index of row to place chip
}

function place_chip(id) {
   // let curr_row = id.slice(0,1); // (starting included index, step)
    let curr_col = parseInt(id.slice(2)); // (starting included index to end)
    let str="";
    let num_chips_in_col = colArr[curr_col];
    let space_avail = find_space(curr_col, num_chips_in_col);

    // prevents highlight error when there is no more spaces in the col
    if(space_avail != -1){
      colArr[curr_col] += 1;

      // update div to put chip in place
      let chip = document.getElementById(space_avail + "_" + curr_col);
      if (player_id == 0) {
        str = `<div class='chip ${player1_color}'></div>`;
      } else {
        str = `<div class='chip ${player2_color}'></div>`;
      }

      chip.innerHTML = str; //put built string into chip
        //spot where chip is placed
      console.log(is_win(space_avail, curr_col));
      update_curr_player();
      update_empties();
    }
    // game draw condition. not a win
    if(empties == 0){
      alert('draw condition');
      // player1 draw++ and total games++
    }
   
    //lose condition
}

function is_win(curr_row, curr_col){
  if(player_id==0){
    player_color = `${player1_color}`;
  }else{
    player_color = `${player2_color}`;
  }

  let accum = 0;
  

  var left_top_row_start = curr_row;
  var left_top_col_start = curr_col;

  // to caculate the top left diagonal spot from curr position
  while(left_top_row_start>0 && left_top_col_start>0){
    left_top_row_start--;
    left_top_col_start--;
  }
  // console.log('start',left_top_row_start ,'_',left_top_col_start)
  // start from top/left diagonal and looks for winning condition going down/right.
  for(let i = left_top_row_start; i<row_max-1 && left_top_col_start < col_max; i++){
    let str = (i)+"_"+(left_top_col_start++);
    let td = document.getElementById(str);
   // console.log(str)
    let chip = (td.firstChild);
    if(chip.classList[1]==player_color){
        accum++;
      }
      else{
        accum=0;
      }
      if(accum == 4){
        return true;
      }
  }

  // to caculate the bottom left diagonal spot from curr position
  var left_btm_row_start=curr_row;
  var left_btm_col_start=curr_col;
  while(left_btm_row_start<row_max-1 && left_btm_col_start>0){
    left_btm_col_start--;
    left_btm_row_start++;
  }
 // console.log('start', left_btm_row_start,'_',left_btm_col_start)
  //start from btm/left diagonal and looks for winning condition going up/right.
  for(let j = left_btm_col_start; j<col_max && left_btm_row_start>0; j++){
    let str = (left_btm_row_start--)+"_"+(j);
    let td = document.getElementById(str);
  //  console.log(str)
    let chip = (td.firstChild);
    if(chip.classList[1]==player_color){
        accum++;
      }
      else{
        accum=0;
      }
      if(accum == 4){
        return true;
      }
   }
  

  // check across the row starting at col0 for winning condition
  for(let j=0; j<col_max; j++){
    let str = curr_row+"_"+(j);
    let td = document.getElementById(str);
    let chip = (td.firstChild);
    if(chip.classList[1]==player_color){
        accum++;
      }
      else{
        accum=0;
      }
      if(accum == 4){
        return true;
      }
  }

let accum_down=1;
  // check down for winning condition
  for(let i=curr_row; i<row_max-1; i++){
    let str = (++curr_row)+"_"+(curr_col);
    let td = document.getElementById(str);
    let chip = (td.firstChild);
      if(chip.classList[1]==player_color){
        accum_down++;
      }
      else{
        accum_down=0;
      }
      if(accum_down == 4){
        return true;
      }
  }

  return false;
}

//updates curr player display
function update_curr_player() {
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

// decrement the number of remaining turns/spaces left on the board
function update_empties(){
  let display = document.getElementById("empties"); 
  empties = parseInt(display.innerText)-1;  
  display.innerText = empties;  
}

create_tbl();