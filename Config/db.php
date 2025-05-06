<?php 
// config/db.php
// Database configuration file
$host = 'localhost'; // Database host
$dbuser = 'root'; // Database username
$dbpass = '';
$dbname = 'e_commerce_db'; // Database name

$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
?>
