<?php 
session_start();
include '../Config/db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = "Cart is Empty";
    header("Location: view_cart.php");
    exit;
}

foreach ($_SESSION['cart'] as $item) {
    $product_id = $item['id'];
    $quantity = $item['quantity'];

    // Check stock
    $stmt = $conn->prepare("SELECT stock FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product || $product['stock'] < $quantity) {
        $_SESSION['error'] = "{$item['name']} is out of stock or insufficient quantity.";
        header("Location: view_cart.php");
        exit;
    }

    // Decrease stock
    $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();
}

// ✅ Done with all items, now clear cart
unset($_SESSION['cart']);
$_SESSION['message'] = "Order Placed Successfully!";
header("Location: ../index.php");
exit;
?>