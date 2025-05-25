<?php
session_start();
include 'Config/db.php'; // Make sure this is included

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shope - Products</title>
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 250px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color:rgb(16, 206, 63);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn.disabled {
            background-color: #aaa;
            pointer-events: none;
        }
    </style>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php if(isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                icon:'success',
                title: 'Success',
                text: <?= json_encode($_SESSION['message']) ?>,
                timer: 2000,
                showConfirmButton: true,
            })
        </script>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <h1>Welcome to Puritea</h1>
    <p><a href="cart/view_cart.php">🛒 View Cart</a></p>
    <a href= "../Ecommerce/Auth/logout.php" class="btn" style="background-color:rgb(195, 143, 148);">Logout</a> 
    <div style="display: flex; flex-wrap: wrap;">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product">
            <?php if (!empty($row['image'])): ?>
                <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="250" height="150">
            <?php else: ?>
                <img src="https://via.placeholder.com/250x150?text=No+Image" alt="No image">
            <?php endif; ?>

            <h2><?= htmlspecialchars($row['name']) ?></h2>
            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
            <p>Price: ₱<?= number_format($row['price']) ?></p>
            <p>Stock: <?= $row['stock'] ?></p>

            <?php if ($row['stock'] > 0): ?>
                <a class="btn" href="cart/add_to_cart.php?id=<?= $row['id'] ?>">Add to cart</a>
            <?php else: ?>
                <a class="btn disabled">Out of stock</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>

</body>
</html>
