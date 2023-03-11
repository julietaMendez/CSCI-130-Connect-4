<?php
session_start();
 
// Unset all of the session variables and destroy the session.
$_SESSION = array();
session_destroy();
 
// Redirect to login page
header("Location: \CSCI-130-CONNECT-4\login\login_register_page.php");
exit;
?>