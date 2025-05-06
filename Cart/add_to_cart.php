<?php
include '../Config/db.php';
session_start(); // Start the session

// validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}
$product_id = (int)$_GET['id'];

// fetch product data
$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

// check if product exists and in stock
if (!$product || $product['stock'] <= 0) {
    $_SESSION['message'] = "Product not found or out of stock.";
    header('Location: ../index.php');
    exit;
}

// initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// add or update product in cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += 1;
} else {
    $_SESSION['cart'][$product_id] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => 1,
        'image' => $product['image']
    ];
}

// optional: redirect back with success message
$_SESSION['message'] = "{$product['name']} has been added to your cart.";

header('Location: ../index.php');
exit;
?>

