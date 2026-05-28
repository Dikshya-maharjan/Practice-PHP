<?php
session_start();

include "../Database/Database.php";

if (!isset($_SESSION['email'])) {
    header("Location: LoginPage.html");
    exit();
}

/* DEFAULT DASHBOARD MENU */
$menu_id = $_GET['menu_id'] ?? 1;

/* INCLUDE HEADER + NAVBAR */
include '../Header/header.php';
include '../Navbar/navbar.php';

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
$stmt->bindParam(':menu_id', $menu_id, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$totalUsers = $result['total_users'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="../Users/UserList.css">
    <link rel="stylesheet" href="../Header/header.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">

    <style>
        .table-container{
            padding: 30px;
        }

        .dashboard-card{
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            background: #f5f5f5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .dashboard-card h2{
            margin-bottom: 10px;
        }

        .dashboard-card p{
            font-size: 30px;
            font-weight: bold;
            color: #0d6efd;
        }

        .back-btn{
            margin-top: 20px;
        }

        .back-btn button{
            padding: 10px 20px;
            border: none;
            background: #0d6efd;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="table-container">

    <div class="dashboard-card">

        <h2>Total Users</h2>

        <p>
            <?php echo $totalUsers; ?>
        </p>

    </div>

    <div class="back-btn">
        <a href="../HomePage/HomePage.php?menu_id=1">
            <button>Back</button>
        </a>
    </div>

</div>

</body>
</html>

<?php include '../Footer/footer.html'; ?>