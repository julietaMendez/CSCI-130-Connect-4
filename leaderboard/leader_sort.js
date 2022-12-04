function sort(sort_criteria){
    if(sort_criteria == "Most Wins"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Wins"){
        send_post("asc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Most Time"){
        send_post("desc_time", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Time"){
        send_post("asc_time", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Most Games"){
        send_post("desc_game", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Games"){
        send_post("asc_game", "leader_sort.php", display_obj_handler);
    }
}

function send_post(send_str, path, callback) {
    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
      alert("Cannot create an XMLHTTP instance");
      return false;
    }
    httpRequest.onreadystatechange = callback;
    httpRequest.open("POST", path);
    httpRequest.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    httpRequest.send(send_str);
}

function display_obj_handler() {
    try {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
          db_obj = JSON.parse(httpRequest.responseText);
          displayObj(db_obj);
        } else {
          alert("There was a problem with the request.");
        }
      }
    } catch (e) {
      alert("Caught Exception: " + e.synopsis);
    }
}

// display an object
function displayObj(arr){
    let tbl = document.getElementById("leaders_tbl");
    tbl.innerHTML="";
    for(let i=0; i<arr.length; i++){
        let tr = document.createElement("TR");
        tbl.appendChild(tr);
        let td = document.createElement("TD");
        tr.appendChild(td);
        td.innerHTML=
        arr[i].username + " " +
        "Wins: " + arr[i].win + " " +
        "Losses: " + arr[i].lose + " " +
        "Draws: " + arr[i].draw + " " +
        "Total Games: " + arr[i].total_games + " " +
        "Total Time: " + arr[i].total_time;
   
    }
}
  