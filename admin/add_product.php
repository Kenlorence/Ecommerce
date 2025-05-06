<?php 
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!== 'admin'){
    header('Location: ../Auth/Login.php');
    exit;

}
include '../Config/db.php'; // Include the database connection file
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "../images/" . $image);

        //prepare the SQL statement
        $stmt = mysqli_prepare($conn, "INSERT INTO products (name, description, image, price, stock) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssdi', $name, $description, $image, $price, $stock);
        if (mysqli_stmt_execute($stmt)){
            header('Location: ../Products/list_products.php');
            exit;
        }else{
            $error = "Error adding product: " . mysqli_error($conn);
            echo $error;
        }
    }else{
        $error = "Error uploading image: " . $_FILES['image']['error'];
        echo $error;
    }
   
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
</head>
<body>
    <h2>Add product</h2>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Description: <textarea name="description" required></textarea><br>
        image: <input type="file" name="image" accept="image/*" required><br>
        Price: <input type="number" name="price" step="0.01" required><br>
        Stock: <input type="number" name="stock" required><br>
        <button type="submit">Add Product</button>
    </form>
    <p><a href="../Products/list_products.php">Back to Products</a></p>
</body>
</html>
