<?php
session_start();
include "../Database/Database.php";

if (!isset($_SESSION['email'])) {
    header("Location: LoginPage.html");
    exit();
}

$menu_id = $_GET['menu_id'] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link rel="stylesheet" href="../Header/header.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">
    <link rel="stylesheet" href="../Homepage/Homepage.css">
</head>

<body>

<?php
include '../Header/header.php';
include '../Navbar/navbar.php';
?>

<div class="mainContainer">

<?php
/* DASHBOARD */
$sql = "
SELECT COUNT(DISTINCT u.id) AS total_users
FROM role_user ru
JOIN users u ON ru.user_id = u.id
JOIN roles r ON ru.role_id = r.id
JOIN menu_role mr ON mr.role_id = ru.role_id
WHERE mr.menu_id = :menu_id
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':menu_id', $menu_id);
$stmt->execute();

$totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'] ?? 0;
?>

<div class="dashboard-card">
    <h2>Dashboard</h2>
    <h3>Total Users</h3>
    <p><?= $totalUsers ?></p>
</div>


</div>
<!-- IMPORTANT: SAFE INCLUDE -->
 <div class="img-card">

     <div class="upload-section">
         <?php include __DIR__ . '/upload.php'; ?>
     </div>
 </div>

</body>
</html>

<?php include "../Footer/footer.html"; ?>