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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-4 text-center">Registration</h2>
   
    <?php if (!empty($error)): ?>
        <p class="text-red-500 text-sm mb-4 text-center"><?php echo htmlspecialchars($error);?></p>
        <?php endif; ?>

    <!-- Registration Form -->
     <form method ="post" class="space-y-4">
        <div>
            <label class="block mb-1">Username:</label>
            <input type="text" name="username" required class="w-full border border-gray-300 py-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Password:</label>
            <input type="text" name="pass" required class="w-full border border-gray-300 py-2 rounded">
        </div>
         <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Register</button>
        
     </form>
     <p>Do you have an account? <a href="login.php">Login</p>
     </div>
</body>
</html>
