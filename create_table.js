// Create the table
var tbl = document.getElementById("table");
var colArr = createColArr(max_col);
var max_col;
var max_row;
var player_id=1;


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
    tbl.border="solid 1px black";
    tbl.style.borderCollapse = "collapse";
  }
}

function shade_col(id) { // on hover
  let col = id.slice(2);
  for(row=0;row<max_row;row++){
    let cell = document.getElementById(row+"_"+col);
    console.log(row+"_"+col);
    cell.style.backgroundColor = "rgb(20,20,116)"; 
  }
}

function normal_col(id) { // not on hover
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

function place_chip(id){
    let curr_col = id.slice(2);
    let curr_row = id.slice(-1);
    let row_place = 0;
    num_chips_in_col = colArr[curr_col];
    if(colArr[curr_col]<= max_row){ // valid placement
      row_place= max_row-(num_chips_in_col+1); 
      colArr[curr_col]+=1;
      } 
    let chip = document.getElementById(row_place+"_"+curr_col);
    chip.innerHTML = "<div class='chip"+player_id+"'></div>";
    player_id==1?player_id=0:player_id=1; //ternary to change players
    console.log(player_id)
}



