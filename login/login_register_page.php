<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Connect4</title>
    <link rel="stylesheet" href="main_page.css" />
    <link rel="stylesheet" href="../game/chip.css" />
  </head>
  <body>

<!-- Sign up section -->
    <header>
        <h1>Connect 4</h1>
        <input type="button" class="chip-btn red">
        <input type="button" class="chip-btn skyblue">
        <input type="button" class="chip-btn yellow">
        <input type="button" class="chip-btn dullpink">
    </header>
    <div class="row">
    <div class="col">
            <h1>Sign Up</h1>
            <p>Please fill this form to create an account.</p>
            <form action="register_mysql.php" method="post">
        
                    <label><sup>*</sup>Username:</label>
                    <input type="text" name="username" />
               
                    <label><sup>*</sup>Password:</label>
                    <input type="password" name="password" />
                
                    <label><sup>*</sup>Confirm Password:</label>
                    <input type="password" name="confirm_password"  />
                 
                    <input type="submit" class="btn" value="submit" />
                    <input type="reset" class="btn" value="Reset" />
           
            </form>
<!-- display all registration errors -->
            <?php
            if(isset($_SESSION['reg_err_message'])){
                foreach ($_SESSION['reg_err_message'] as $error){
                echo $error.'<br>';}
            }
            ?>

        </div>
        
<!-- Login Section -->
<div class="col">
            <h1>Login</h1>
            <p>Please fill in your credentials to login.</p>
            <form action="login_mysql.php" method="post">  
                    <label><sup>*</sup>Username:</label>
                    <input type="text" name="username" value="" />
                    <label><sup>*</sup>Password:</label>
                    <input type="password" name="password" />
                    <input type="submit" class="btn" value="submit" />
            </form>
<!-- display all login errors -->
            <?php
            // display all returned errors 
            if(isset($_SESSION['login_err_message'])){
                // session_start();
                foreach ($_SESSION['login_err_message'] as $error){
                echo $error.'<br>';}
            }
            ?>
        </div>
    </div>
  </body>    
</html>
<?php session_destroy(); ?>



