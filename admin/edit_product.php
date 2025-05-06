<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../Auth/Login.php');
    exit;
}

include '../Config/db.php'; // Include the database connection file

$id = $_GET['id'] ?? null; // Get the product ID from the URL

if (!$id) {
    header('Location: ../Products/list_products.php');
    exit;
}

// Fetch product data
$stmt = mysqli_prepare($conn, "SELECT name, description, price, stock FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $description, $price, $stock);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);

    $stmt = mysqli_prepare($conn, "UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssdii', $name, $description, $price, $stock, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../Products/list_products.php');
        exit;
    } else {
        $error = "Error updating product: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="post"">
        Name: <input type = "text" name="name" value="<?= htmlspecialchars($name) ?>" required><br>
        Description: <textarea name="description" required><?= htmlspecialchars($description) ?></textarea><br>
        Price: <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($price) ?>" required><br>
        Stock: <input type="number" name="stock" value="<?= htmlspecialchars($stock) ?>" required><br>
        <button type="submit">Update Product</button>
    </form>
    <p><a href="../products/list_products.php">Back to Products</a></p>
</body>
</html>

