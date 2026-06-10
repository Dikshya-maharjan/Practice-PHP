<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="navbar">
        <h2>Blog System</h2>

        <nav>
            <a href="../index.php">Home</a>
            <a href="Article/create_articles.php">Create Article</a>
            <a href="Article/view_articles.php">Articles</a>
            
<?php if (isset($_SESSION['user_id'])): ?>
    <a href="Logout/logout.php" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i>
    </a>
<?php else: ?>
    <a href="../Login/loginpage.php">Login</a>
<?php endif; ?>
        </nav>
    </div>
</header>