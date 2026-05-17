 <?php
session_start();
include_once "../Database/Database.php";
if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
}
$menu_id = $_GET['menu_id'];
// Get users + roles who can access this menu
$sql = "
SELECT 
    u.id AS user_id,
    u.email AS user_name,
    r.id AS role_id,
    r.role_name
FROM menu_role rm
JOIN roles r ON rm.role_id = r.id
JOIN role_user ru ON ru.role_id = r.id
JOIN users u ON ru.user_id = u.id
WHERE rm.menu_id = :menu_id
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':menu_id', $menu_id);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Users/UserList.css">
    <title>Document</title>
</head>
<body>
    <div class="table_container">

        <h2>Access Role </h2>
        <table border="1">
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Role ID</th>
            <th>Role Name</th>
        </tr>
    
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['user_id'];?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['role_id'];?></td>
                <td><?php echo $row['role_name']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="../HomePage/HomePage.php">
    <button>Back</button>
    </div>
</a>
</body>
</html> 