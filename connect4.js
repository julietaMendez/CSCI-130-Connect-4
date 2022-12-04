// table variables
let size_str = document.getElementById("board_size").innerText;
var col_max = size_str.slice(0, 1); // num of columns
var row_max = size_str.slice(2); // num of rows
var tbl = document.getElementById("connect_4_table");
var colArr = createColArr(col_max); // the number of chips inside a column
var empties; // amount of empty spaces left on the board
var player_id = 1;
var p1_3_in_a_rows = 0;
var p2_3_in_a_rows = 0;

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

function shade_col(id) {
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

      if(player_id == 0){
        player_color = `${player1_color}`;
      }else{
        player_color = `${player2_color}`;
      }

      let str = "<div class='chip "+player_color+"'></div>";
    
      chip.innerHTML = str; //put built string into chip
        //spot where chip is placed
      if(is_win(space_avail, curr_col)){
        // dynamically create winner popup w/curr player's name
        let popup = document.getElementById("win_popup");
        popup.innerHTML = "<h1>"+curr_player.innerText+" Wins!</h1> <button onclick=redirect_game_options()>Return to Game Options</button>"
        popup.classList.remove('hidden');
        popup.classList.add('show_popup');
      };
      total_3_in_a_row(space_avail, curr_col);
      update_curr_player();
      update_empties();
    }
    // game draw condition. not a win
    if(empties == 0){
      let popup = document.getElementById("draw_popup");
      popup.innerHTML = "<h1>DRAW!</h1> <button onclick=redirect_game_options()>Return to Game Options</button>"
      popup.classList.remove('hidden');
      popup.classList.add('show_popup');
    }
   
    //lose condition
}

function total_3_in_a_row(curr_row, curr_col){
  let accum3 = 0;
  let traverses = 0;

  // Down ----------------------------------------------------------------------
  for(let i=curr_row; i < row_max && traverses < 3; i++){
    let str = i+"_"+curr_col; // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3);
    if(accum3 == 3){
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
  }

  // Across: Check 2 to the LEFT -----------------------------------------------
  traverses=0;
  accum3=0;
  for(let j=curr_col; j > 0 && traverses < 3; j--){
    let str = curr_row+"_"+(j); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
  }

  // Across: Check 2 to the RIGHT -----------------------------------------------
  traverses=0;
  accum3=0;
  for(let j=curr_col; j < col_max && traverses < 3; j++){
    let str = curr_row+"_"+(j); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
  }

  // Across: Check 1 to the LEFT and Check 1 to the RIGHT -------------------------
  if(curr_col>0){ // check 1 place to the LEFT
    let str = curr_row+"_"+(curr_col-1); // creates LEFT neighbors chips id
    let td = document.getElementById(str);
    let chip = (td.firstChild);
    if(chip.classList[1]==player_color){ // check if LEFT neighbor is the same color
        if(curr_col < col_max-1){ // if so, check if RIGHT neighbor is the same color
          let str = curr_row+"_"+(curr_col+1); // creates RIGHT neighbors chips id
          let td = document.getElementById(str);
          let chip = (td.firstChild);
          if(chip.classList[1]==player_color){ // If so, increment 3-in-a-row and update stats display
            update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
          }
        }
      }
  }

  // \ Diagonal: 2 to the TOP/LEFT ---------------------------------------------------
  let col = curr_col;
  traverses=0;
  accum3=0;
  for(let i = curr_row; i > 0 && col > 0 && traverses < 3; i--){
    let str = (i)+"_"+(col); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
    col--;
  }

  // \ Diagonal: 2 to the BOTTOM/RIGHT ---------------------------------------------------
  col = curr_col;
  traverses=0;
  accum3=0;
  for(let i = curr_row; i < row_max && col < col_max && traverses < 3; i++){
    let str = (i)+"_"+(col); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
    col++;
  }

 // Diagonal \: 1 to the TOP/LEFT and 1 to the BOTTOM/RIGHT -----------------------------
  if(curr_row > 0 && curr_col > 0){
    let str = (curr_row-1)+"_"+(curr_col-1); // creates TOP/LEFT neighbors chips id
    let td = document.getElementById(str);
    let chip = (td.firstChild);   
    if(chip.classList[1]==player_color){ // check if TOP/LEFT neighbor is the same color
      if(curr_row < row_max-1 && curr_col < col_max-1){ // if so, check if BOTTOM/RIGHT neighbor is the same color
        let str = (curr_row+1)+"_"+(curr_col+1); // creates BOTTOM/RIGHT neighbors chips id
        let td = document.getElementById(str);
        let chip = (td.firstChild);
        if(chip.classList[1]==player_color){ // If so, increment 3-in-a-row and update stats display
          update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
        }
      }
    }
  }

  // Diagonal /: 2 to the TOP/RIGHT ---------------------------------------------------
  col = curr_col;
  traverses=0;
  accum3=0;
  for(let i = curr_row; i > 0 && col < col_max && traverses < 3; i--){
    let str = (i)+"_"+(col); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
    col++;
  }

  // Diagonal /: 2 to the BOTTOM/LEFT ---------------------------------------------------
  col = curr_col;
  traverses=0;
  accum3=0;
  for(let i = curr_row; i < row_max && col >= 0 && traverses < 3; i++){
    let str = (i)+"_"+(col); // creates neighboring chips id
    accum3 = count_in_a_row(str, accum3); 
    if(accum3 == 3){ // found 3-in-a-row
      update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
    }
    traverses++;
    col--;
  }

  // Diagonal /: 1 to the BOTTOM/LEFT and 1 to the TOP/RIGHT -----------------------------
  if(curr_row < row_max-1 && curr_col > 0){
    let str = (curr_row+1)+"_"+(curr_col-1); // creates BOTTOM/LEFT neighbors chips id
    let td = document.getElementById(str);
    let chip = (td.firstChild);
    if(chip.classList[1]==player_color){ // check if BOTTOM/LEFT neighbor is the same color
      if(curr_row > 0 && curr_col < col_max-1){ // if so, check if TOP/RIGHT neighbor is the same color
        let str = (curr_row-1)+"_"+(curr_col+1); // creates TOP/RIGHT neighbors chips id
        let td = document.getElementById(str);
        let chip = (td.firstChild);
        if(chip.classList[1]==player_color){ // If so, increment 3-in-a-row and update stats display
          update_3_in_a_row_stat(player_color); // assign the correct player the total of 3-in-a-rows
        }
      }
    } 
  }

}

function update_3_in_a_row_stat(player_color){
  if(player_color == `${player1_color}`){
    document.getElementById("p1_3_in_a_row").innerHTML = "3 In A Rows: " + (++p1_3_in_a_rows);
  }
  else{
    document.getElementById("p2_3_in_a_row").innerHTML =  "3 In A Rows: " + (++p2_3_in_a_rows);
  } 
}

function count_in_a_row(str_id, accum){
  let td = document.getElementById(str_id);
  let chip = (td.firstChild);
  if(chip.classList[1]==player_color){
      accum++;
    }
    else{
      accum=0;
    }
    return accum;
}

function is_win(curr_row, curr_col){
  // 1. Top/Left Diagonal To Bottom/Right Diagonal -----------------------------
  let accum = 0; // 4-in-a-row counter
  var left_top_row_start = curr_row; 
  var left_top_col_start = curr_col;

  // to caculate the top left diagonal spot from curr position
  while(left_top_row_start>0 && left_top_col_start>0){
    left_top_row_start--;
    left_top_col_start--;
  }

  // starts from top/left diagonal and looks for winning condition going down/right.
  for(let i = left_top_row_start; i<row_max && left_top_col_start < col_max; i++){
    let str = (i)+"_"+(left_top_col_start++); // creates neighboring chips id
    accum = count_in_a_row(str, accum); 
    if(accum == 4){ // found 4-in-a-row
      return true;
    }
  }

  // 2. Bottom/Left Diagonal To Top/Right Diagonal -----------------------------
  accum=0;
  var left_btm_row_start=curr_row;
  var left_btm_col_start=curr_col;

  // to caculate the bottom left diagonal spot from curr position
  while(left_btm_row_start<row_max-1 && left_btm_col_start>0){
    left_btm_col_start--;
    left_btm_row_start++;
  }

  // starts from btm/left diagonal and looks for winning condition going up/right.
  for(let j = left_btm_col_start; j<col_max && left_btm_row_start>0; j++){
    let str = (left_btm_row_start--)+"_"+(j); // creates neighboring chips id
    accum = count_in_a_row(str, accum); 
    if(accum == 4){ // found 4-in-a-row
      return true;
    }
   }

  // 3. Horizontal from col0 to end --------------------------------------------
  accum=0;
  for(let j=0; j<col_max; j++){
    let str = curr_row+"_"+(j); // creates neighboring chips id
    accum = count_in_a_row(str, accum); 
    if(accum == 4){ // found 4-in-a-row
      return true;
    }
  }

  // 4. Down -------------------------------------------------------------------
  accum=1; // starts at 1 to include the chip played
  for(let i=curr_row; i<row_max-1; i++){
    let str = (++curr_row)+"_"+(curr_col); // creates neighboring chips id
    accum = count_in_a_row(str, accum); 
    if(accum == 4){ // found 4-in-a-row
      return true;
    }
  }

  return false;
}

function update_curr_player() { //updates curr player display
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

function pretty_stats(){ // hilight players name with their chip color
  player1 = document.getElementById("p1_name").classList;
  player1.add(player1_color);

  player2 = document.getElementById("p2_name").classList;
  player2.add(player2_color);
}

function update_empties(){ // decrement the number of remaining turns/spaces left on the board
  let display = document.getElementById("empties"); 
  empties = parseInt(display.innerText)-1;  
  display.innerText = empties;  
}

function redirect_game_options(){
  window.location.replace("/CSCI-130-CONNECT-4/game_options.php");
}

create_tbl();
pretty_stats();