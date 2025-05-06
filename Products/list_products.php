<?php 
session_start(); // Start the session
include '../Config/db.php'; // Include the database connection file

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC"); // Fetch all products
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?= htmlspecialchars($_SESSION['username']) ?>! <a href="../Auth/logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="../Auth/login.php">Login</a></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php while($p = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><img src="../images/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" width="100"></td>
                    <td><?= number_format($p['price'], 2) ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="../admin/edit_product.php?id=<?= $p['id'] ?>">Edit</a> | 
                            <a href="../admin/delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        <?php else: ?>
                            <?php if($p['stock'] > 0): ?>
                                <a href="../cart/add_to_cart.php?id=<?= $p['id'] ?>">Add to Cart</a>
                            <?php else: ?>
                                Out of Stock
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php if(isset($_SESSION['role']) && $_SESSION['role']==='admin'): ?>
        <p><a href="../admin/add_product.php">Add New Product</a></p>
        <?php endif; ?>
</body>
</html>
