// Create the table

var tbl = document.getElementById("table");
var colArr = new Array(); //keep track of spots taken within col at index i

function create_tbl() {
  //add row to tbl
  for (i = 0; i < 6; i++) {
    let row = tbl.insertRow();
    for (j = 0; j < 7; j++) {
      let cell = row.insertCell();
      cell.setAttribute("id", i+'_'+j)
      cell.setAttribute("onclick", "place_chip(this.id)");
    }
    tbl.border="solid 1px black";
    tbl.style.borderCollapse = "collapse";
  }
}

//3 for col, 4 row saved at row 5 col 3
function place_chip(id){
    let x = document.getElementById(id);
    let col = id.slice(2);
    let row = id.slice(0);
    let rowPlace = 0;
    if(colArr[col]<= 5){ // valid placement
      rowPlace = 6 - (colArr[col] + 1); //numRows - numChips at col = 1
      // place it at [rowPlace,col] = [2,3]
      } 
    x.innerHTML = "<div class='chip1'></div>";

}

create_tbl();

