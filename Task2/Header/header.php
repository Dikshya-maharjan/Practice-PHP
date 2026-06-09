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
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<header>
    <div class="navbar">
        <h2>Blog System</h2>

        <nav>
            <a href="../Task2/index.php">Home</a>
            <a href="../Task2/create_article.php">Create Article</a>
            <a href="../Task2/view_articles.php">Articles</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="../Login/logout.php">Logout</a>
            <?php else: ?>
                <a href="../Login/loginpage.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>