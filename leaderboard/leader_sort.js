function sort(sort_criteria){
    if(sort_criteria == "Most Wins"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Wins"){
        send_post("asc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Most Time"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Time"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Most Game"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
    }
    if(sort_criteria == "Least Game"){
        send_post("desc_win", "leader_sort.php", display_obj_handler);
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
          console.log(db_obj[0]);
        } else {
          alert("There was a problem with the request.");
        }
      }
    } catch (e) {
      alert("Display: Caught Exception: " + e.synopsis);
    }
}