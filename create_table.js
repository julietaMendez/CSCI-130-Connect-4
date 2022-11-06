// Create the table
var tbl = document.getElementById("connect_4_table");
var colArr = createColArr(max_col);
var max_col;
var max_row;
var player_color0="red";
var player_color1="yellow";
var player_id=0;
var curr_player = document.getElementById("curr_player");

function createColArr(max_col){
  var arr = new Array(); //keep track of spots taken within col at index i
  for(i=0;i<max_col; i++){
    arr[i] = 0;
  }
  return arr;
}

function create_tbl(tbl_size) {
  // slice the id to get the board size 
  max_col = tbl_size.slice(5);
  max_row = tbl_size.slice(3,4);

  clear_tbl();
  //add rows to tbl
  for (i = 0; i < max_row; i++) {
    let row = tbl.insertRow();
    // add cols to tbl. The cols have unique id's that reflect their location
    for (j = 0; j < max_col; j++) {
      let cell = row.insertCell();
      cell.setAttribute("id", i+'_'+j)
      cell.setAttribute("onclick", "place_chip(this.id)");
      cell.innerHTML = "<div class='empty_space'></div>";
      cell.setAttribute("onmouseover", "shade_col(this.id)");
      cell.setAttribute("onmouseout", "normal_col(this.id)");
    }
    tbl.border="solid 10px black";
    tbl.style.borderCollapse = "collapse";
  }
}

function shade_col(id) { // onmouseover: on hover
  let col = id.slice(2);
  for(row=0;row<max_row;row++){
    let cell = document.getElementById(row+"_"+col);
    cell.style.backgroundColor = "rgb(20,20,116)"; 
  }
  let shade_space = find_space(col, colArr[col]);
  let chip = document.getElementById(shade_space+"_"+col);
  chip.style.backgroundColor = "pink";
}

function normal_col(id) { // onmouseout: not on hover
  let col = id.slice(2);
  for(row=0;row<max_row;row++){
    let cell = document.getElementById(row+"_"+col);
    cell.style.backgroundColor = "rgb(25, 25, 158)";
  }
}

function clear_tbl(){
  colArr = [];  //reset the array for a new board
  for(i=0;i<max_col; i++){
    colArr[i] = 0;
  }
  tbl.innerHTML = '';
}

function find_space(curr_col, num_chips_in_col){
  space_avail=0;
  if(num_chips_in_col<= max_row){ // valid placement
    space_avail= max_row-(num_chips_in_col+1); // calculates first available placement
    } 
  return space_avail; // returns index of row to place chip
}

function place_chip(id){
    let curr_col = id.slice(2);
    let curr_row = id.slice(-1);
    let num_chips_in_col = colArr[curr_col];
    let space_avail = find_space(curr_col, num_chips_in_col);
    colArr[curr_col]+=1;

    let chip = document.getElementById(space_avail+"_"+curr_col);
    if (player_id==0){
      str = `<div class='chip${player_id} ${player_color0}'></div>`;
    }
    else{
      str = `<div class='chip${player_id} ${player_color1}'></div>`;
    }
    console.log(str)
    
    chip.innerHTML = str
    if(player_id==1){
      curr_player.innerHTML = player_color0;
    }
    else{
      curr_player.innerHTML = player_color1;
    }

    player_id==1?player_id=0:player_id=1; //ternary to change players
}

function set_chip_color_p1(color){
  //p1 cannot choose the same color as p2
  if(player_color1 != color){
    let p1 = document.getElementById("p1_color");
    player_color0=color;
    p1.innerHTML = player_color0;
    let curr_p = document.getElementById("curr_player");
    curr_p.innerHTML = player_color0;
  }
}

function set_chip_color_p2(color){
  //p2 cannot choose the same color as p1
  if(player_color0 != color){ 
    let p2 = document.getElementById("p2_color");
    player_color1=color;
    p2.innerHTML = player_color1;
  }
}
