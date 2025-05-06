<?php 
session_start();

$cart = $_SESSION['cart'] ?? [];
$total = 0;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your cart</title>

    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto;}
        th, td{
            padding: 10px; border: 1px solid #ccc; text-align: center;}
        .btn {
            padding: 5px 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px;
        }
        .checkout{
            background: #28a745;
        }

    
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   <?php if(isset($_SESSION['message'])):?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: <?= json_encode($_SESSION['message']) ?>,
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <h2 style="text-align: center;"> Your Shopping Cart</h2>
    <?php if (empty($cart)): ?>
    <p style="text-align: center">Your cart is empty.</p>
    <p style="text-align: center;"><a href="../index.php">Continue Shopping</a></p>
    <?php else: ?>
        <table>
           <thead>
            <tr>
            <th>Product</th>
            <th>Prince</th>
            <th>Quantity</th>
            <th>SubTotal</th>
            <th>Action</th>
            </tr>
           </thead> 
            <tbody>
            <?php foreach ($cart as $item): 
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td>₱<?= number_format($item['price'], 2) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>₱<?= number_format($subtotal, 2) ?></td>
            <td><a class="btn" href="remove_item.php?id=<?= htmlspecialchars($item['id']) ?>">Remove</a></td>
        </tr>
    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                        <td colspan="2"><strong>₱<?= number_format($total, 2) ?></strong></td>
                    </tr>
            </tbody>
        </table>
        <div style="text-align: center;">
            <a class="btn checkout" href="checkout.php">Checkout</a>
            <a class="btn" href="../index.php">Continue Shopping</a>
        </div>
    <?php endif; ?>
</body>
</html>