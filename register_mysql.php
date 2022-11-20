<?php
// connect to db
require_once 'db_connect.php';

session_start();
$err_arr = array();   //array of errors to return 
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";

if(($_POST["username"]) == NULL){   //prevents empty username input
    array_push($err_arr, "Please enter a username.");
} else {
    // Prepare a select statement to check if username already exists
    $sql = "SELECT pkey FROM player_tbl WHERE username = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);       
        $param_username = trim($_POST["username"]);          
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            // check if username already exists
            if(mysqli_stmt_num_rows($stmt) == 1){
                array_push($err_arr, "This username is already taken.");
            } else{
                // username is available
                $username = trim($_POST["username"]);
                echo 'username '.$username.' available';
            }
        } else{
            array_push($err_arr, "Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
}


// Process password input
if(empty(trim($_POST['password']))){
    array_push($err_arr, "Please enter a password.");
} elseif(strlen(trim($_POST['password'])) < 6){
    array_push($err_arr,"Password must have atleast 6 characters.");
} else{
    $password = trim($_POST['password']);
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
    array_push($err_arr, 'Please confirm password.');    
} else{
    $confirm_password = trim($_POST['confirm_password']);
    if($password != $confirm_password){
        array_push($err_arr, 'Password did not match.');
    }
}

// Check input errors before inserting in database
// if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
if(empty($err_arr)){
    
    // Prepare an insert statement
    $sql = "INSERT INTO player_tbl (username, password) VALUES (?, ?)";
  
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
       
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // hash password
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to game page and start session
            $_SESSION['username'] = $username;      
            header("Location: ./game_options_copy.php");
            exit;
        } else{
            array_push($err_arr, "Something went wrong. Please try again later.");
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // return array of errors to login page
    $_SESSION['reg_err_message'] = $err_arr;    
    header("Location: ./login_register_page.php");
}
// Close connection
mysqli_close($conn);

?>
