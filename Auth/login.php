<?php 
session_start(); // Start the session
include '../Config/db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']); // Remove spaces
    $password = $_POST['pass'];

    // Fetch user row
    $stmt = mysqli_prepare($conn, "SELECT id, pass, role FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hash, $role);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify password
    if (isset($hash) && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['role'] = $role;
        $_SESSION['username'] = $username; // Store username in session

        // Redirect Based on role
        if ($role == 'admin') {
            header('Location: ../admin/add_product.php');
        } else {
            header('Location: ../index.php');
        }
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($_GET['registered'])) echo "<p style='color:green;'>Registration successful, please login.</p>"; ?>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"?>
    <form method ='POST'>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="pass" required><br>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</body>
</html>
