<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Connect4</title>
    <link rel="stylesheet" href="main_page.css" />

  </head>
  <body>
<!-- Sign up section -->
    <header><h1>Connect 4</h1></header>
    <div class="row">
        <div class="col">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="register_mysql.php" method="post">
                <div>
                    <label><sup>*</sup>Username:</label>
                    <input type="text" name="username" />
                    <span></span>
                </div>
                <div>
                    <label><sup>*</sup>Password:</label>
                    <input type="password" name="password" />
                    <span></span>
                </div>
                <div>
                    <label><sup>*</sup>Confirm Password:</label>
                    <input type="password" name="confirm_password"  />
                    <span></span>
                </div>
                <div>
                    <input type="submit" value="submit" />
                    <input type="reset" value="Reset" />
                </div>
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
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="login_mysql.php" method="post">
                <div>
                    <label><sup>*</sup>Username:</label>
                    <input type="text" name="username" value="" />
                    <span></span>
                </div>
                <div>
                    <label><sup>*</sup>Password:</label>
                    <input type="password" name="password" />
                    <span></span>
                </div>
                <div>
                    <input type="submit" value="submit" />
                </div>
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



