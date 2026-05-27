<?php
session_start();
include "../Database/Database.php";
include '../Header/header.php';
include '../Navbar/navbar.php';

if (!isset($_SESSION['email'])) {
    header("Location: LoginPage.html");
    exit();
}

if (!isset($_GET['menu_id'])) {
    header("Location: ../HomePage/HomePage.php");
    exit();
}

$menu_id = $_GET['menu_id'];

/* GET TOTAL USERS */
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

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$totalUsers = $result['total_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../Users/UserList.css">
    <link rel="stylesheet" href="../Header/header.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">

    <title>Total Users</title>
</head>

<body>

<div class="table-container">

    <h2>Total Users: <?php echo $totalUsers; ?></h2>

    <a href="../HomePage/HomePage.php">
        <button>Back</button>
    </a>

</div>

</body>
</html>

<?php
include '../Footer/footer.html';
?>