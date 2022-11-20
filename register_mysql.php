<?php
// connect to db
require_once 'db_connect.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} else{
    // Prepare a select statement to check if username already exists
    $sql = "SELECT pkey FROM player_tbl WHERE username = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);       
        $param_username = trim($_POST["username"]);          
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            // check if username already exists
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                // username is available
                $username = trim($_POST["username"]);
                echo 'username '.$username.' available';
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
}

// Process password input
if(empty(trim($_POST['password']))){
    $password_err = "Please enter a password.";
    echo $password_err;   
} elseif(strlen(trim($_POST['password'])) < 3){
    $password_err = "Password must have atleast 6 characters.";
    echo $password_err;
} else{
    $password = trim($_POST['password']);
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = 'Please confirm password.';     
    echo $confirm_password_err;
} else{
    $confirm_password = trim($_POST['confirm_password']);
    if($password != $confirm_password){
        $confirm_password_err = 'Password did not match.';
        echo $confirm_password_err;
    }
}

// Check input errors before inserting in database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    
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
            session_start();
            $_SESSION['username'] = $username;      
            header("Location: ./game_options_copy.php");
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
}
// Close connection
mysqli_close($conn);
// }