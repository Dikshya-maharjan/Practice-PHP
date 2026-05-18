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
FROM role_user ru
JOIN users u ON ru.user_id = u.id
JOIN roles r ON ru.role_id = r.id
JOIN menu_role mr 
    ON mr.role_id = r.id 
   AND mr.menu_id = :menu_id
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
    <?php 
        if ($_SESSION['role'] === 'superadmin') { ?>
            <a href="../AssignRole/assign_role.php">
                <button id="assignBtn">Go to Assign Role</button>
            </a>
        <?php } ?>
        <h2>Access Role </h2>
        <table border="1">
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Role ID</th>
            <th>Role Name</th>
            <th>Action</th>
        </tr>
    
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['user_id'];?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['role_id'];?></td>
                <td><?php echo $row['role_name']; ?></td>
                <td>
        <!-- EDIT -->
        <a href="../Button/edit_role.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>
                    onclick="return confirm('Are you sure you want to update this role');">

            <button style="background:green;color:white;padding:5px 10px;border:none;border-radius:5px;">
                Edit
            </button>
        </a>

        <!-- DELETE -->
        <a href="../Button/delete_role.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>"
           onclick="return confirm('Are you sure you want to delete this role?');">
            <button style="background:red;color:white;padding:5px 10px;border:none;border-radius:5px;">
                Delete
            </button>
        </a>
    </td>

            
            </tr>
        <?php } ?>
    </table>
    <a href="../HomePage/HomePage.php">
    <button>Back</button>
    </div>
</a>
</body>
</html>