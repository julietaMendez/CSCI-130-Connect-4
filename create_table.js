// Create the table
var tbl = document.getElementById("table");
var colArr = createColArr(max_col);
var max_col;
var max_row;


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
    }
    tbl.border="solid 1px black";
    tbl.style.borderCollapse = "collapse";
  }
}

function clear_tbl(){
  colArr = [];  //reset the array for a new board
  for(i=0;i<max_col; i++){
    colArr[i] = 0;
  }
  tbl.innerHTML = '';
}

//3 for col, 4 row saved at row 5 col 3
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
    chip.innerHTML = "<div class='chip1'></div>";
}



