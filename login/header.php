<?php
    session_start();
    if (isset($_SESSION['username'])) {
      // This session already exists, should already contain data
        echo "User ID:", $_SESSION['username'], "<br />"
    } else {
        // New PHP Session / Should Only Be Run Once/Rarely/Login/Logout
        session_destroy(); 
        header("Location: ./login/login_register_page.php");
    }
?>