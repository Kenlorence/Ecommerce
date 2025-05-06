<?php

session_start(); // Start the session
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../Auth/Login.php');
    exit;
}
include '../Config/db.php'; // Include the database connection file

$id = $_GET['id'] ?? null;
if ($id){
    mysqli_query($conn, "DELETE FROM products WHERE id = ".(int)$id);

}
header('Location: ../Products/list_products.php');
exit;

?>