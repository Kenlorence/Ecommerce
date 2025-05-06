<?php 
session_start(); // Start the session
include_once '../Config/db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username']; // fixed typo
    $password = $_POST['pass'];

    $hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Insert into DB
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, pass) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $hash);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: login.php?registered=1'); // fixed typo
        exit();
    } else {
        echo "Registration Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Registration</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Registration Form -->
     <form method ="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="pass" required><br>
        <button type="submit">Register</button>
     </form>
     <p>Do you have an account? <a href="login.php">Login</p>
</body>
</html>
