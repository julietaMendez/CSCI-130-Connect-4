<?php
// connect to db
require_once 'db_connect.php';
 
$username = $password = "";
$username_err = $password_err = "";

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM player_tbl WHERE username = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
           // run stmt and check db for any matching results. 
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);  // get query results
                if(mysqli_stmt_num_rows($stmt) == 1){  // found matching username in db  
					mysqli_stmt_bind_result($stmt, $username, $hashed_password);     
                    if(mysqli_stmt_fetch($stmt)){
                        // echo $password ." user input <br>";
						// echo $hashed_password ." from db<br>";
                        echo 'pass verify?: '.password_verify($password, $hashed_password);
                        // check that input pass == hashed pass
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("Location: ./game_options_copy.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($conn);
