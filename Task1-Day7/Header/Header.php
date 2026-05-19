<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: /InternPHP/Task1-Day7/LoginPage.html");
    exit();
}
?>

<div class="header">

    <div class="header-left">

        <img src="/InternPHP/Task1-Day7/Header/logo.png" alt="logo">

        <h3>
            Welcome,
            <?php echo htmlspecialchars($_SESSION['email']); ?>
        </h3>

    </div>

</div>