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
    tbl.innerHTML="<th><h3>Rank</h3></th><th><h3>UserName</h3></th><th><h3>Wins</h3></th><th><h3>Losses</h3></th><th><h3>Draws</h3></th><th><h3>Total Games</h3></th><th><h3>Total Time</h3></th>";
    for(let i=0; i<arr.length; i++){
        let tr = document.createElement("TR");
        tbl.appendChild(tr);

        let td0 = document.createElement("TD");
        tr.appendChild(td0);
        td0.innerHTML=i+1;

        let td1 = document.createElement("TD");
        tr.appendChild(td1);
        td1.innerHTML=arr[i].username;

        let td2 = document.createElement("TD");
        tr.appendChild(td2);
        td2.innerHTML=arr[i].win;

        let td3 = document.createElement("TD");
        tr.appendChild(td3);
        td3.innerHTML=arr[i].lose;

        let td4 = document.createElement("TD");
        tr.appendChild(td4);
        td4.innerHTML=arr[i].draw;

        let td5 = document.createElement("TD");
        tr.appendChild(td5);
        td5.innerHTML=arr[i].total_games;

        let td6 = document.createElement("TD");
        tr.appendChild(td6);
        td6.innerHTML=arr[i].total_time;
    }
}
  