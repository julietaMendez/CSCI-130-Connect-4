// Create the table

var tbl = document.getElementById("table");
var colArr = createColArr();

function createColArr(){
  var arr = new Array(); //keep track of spots taken within col at index i
  for(i=0;i<6; i++){
    arr[i] = 0;
  }
  return arr;
}

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
    //let x = document.getElementById(id);
    let col = id.slice(2);
    let row = id.slice(0);
    let row_place = 0;
    num_chips_in_col = colArr[col];
    console.log(num_chips_in_col);
    if(colArr[col]<= 5){ // valid placement
      row_place= 6-(num_chips_in_col+1); 
      colArr[col]+=1;
      // place it at [rowPlace,col] 
      } 
    let chip = document.getElementById(row_place+"_"+col);
    console.log(row_place+"_"+col);
    chip.innerHTML = "<div class='chip1'></div>";

}

create_tbl();

