// Create the table

var tbl = document.getElementById("table");

function create_tbl() {
  //add row to tbl
  for (i = 0; i < 6; i++) {
    let row = tbl.insertRow();
    for (j = 0; j < 7; j++) {
      let cell = row.insertCell();
      cell.setAttribute("id", i+'_'+j)
      cell.setAttribute("onclick", "get_id(this.id)");
    }
    tbl.border="solid 1px black";
    tbl.style.borderCollapse = "collapse";
  }
}

function get_id(id){
    let x = document.getElementById(id);
    x.innerHTML = "<div class='chip1'></div>";

}

create_tbl();

