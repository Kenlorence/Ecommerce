<?php
session_start(); // Start the session
include '../Config/db.php'; // Include the database connection file

if (isset($_GET['id']) && is_numeric($_GET['id'])){

    $id = (int)$_GET['id'];
    if (isset($_SESSION['cart'][$id])){
        $name = $_SESSION['cart'][$id]['name'] ?? 'item';
        unset($_SESSION['cart'][$id]);
       
    }
    $_SESSION['message'] = "$name has been added to your cart.";
}

header('Location: view_cart.php');
exit; // Exit the script



?>