<?php 

// for logout

session_start(); // Start the session
session_unset();
session_destroy(); // Destroy the session
header('Location: login.php'); // Redirect to login page
exit(); // Ensure no further code is executed after the redirect



?>
