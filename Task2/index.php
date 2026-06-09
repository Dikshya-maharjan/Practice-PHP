<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login/loginpage.php");
    exit();
}

// Get session value
$name = $_SESSION['name'] ?? 'User';
$email = $_SESSION['email'] ?? '';
$role = $_SESSION['role'] ?? 'user';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header -->
    <?php include 'Header/header.php'; ?>

    <main>

        <h1>Blog System Dashboard</h1>

        <h2>Welcome, <?php echo htmlspecialchars($name); ?> </h2>

        <p>Email: <?php echo htmlspecialchars($email); ?></p>

        <p><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>

        <hr>

        <h3>Menu</h3>
        <section>
        
        <section>

        <section> 
        <a href="Login/logout.php">
            <button>Logout</button>
        </a>
        <section>

    </main>
    
</body>
</html>

    <!-- Footer -->
    <?php include 'Footer/footer.php'; ?>