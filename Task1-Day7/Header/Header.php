<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: /InternPHP/Task1-Day7/LoginPage.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Document</title>
</head>
<body>
    
    <div class="header">
    
        <div class="header-left">
    
            <img src="/InternPHP/Task1-Day7/Header/logo.png" alt="logo">
    
            <h3>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['email']); ?>
            </h3>
    
        </div>
    
    </div>
</body>
</html>
