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
    <link rel="stylesheet" href="assignrole.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>
    <div class="table-container">

        <a href="../HomePage/HomePage.php" class="back-btn">
       <button class="btn btn-lg"> <i class="bi bi-arrow-left-square-fill"></i></button>
        </a>
<h2>Access Role</h2>

<table border="1" class="table table-hover">
<tr>
    <th>User ID</th>
    <th>User Name</th>
    <th>Role ID</th>
    <th>Role Name</th>
    <th>Action</th>
</tr>

<?php foreach ($data as $row) { ?>
<tr>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['user_name']; ?></td>
    <td><?php echo $row['role_id']; ?></td>
    <td><?php echo $row['role_name']; ?></td>

    <td>
        <a href="../Button/edit_role.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>"
           onclick="return confirm('Edit this role?');">
            <button class="btn btn-primary">Edit</button>
        </a>

        <a href="../Button/delete_role.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>"
           onclick="return confirm('Delete this role?');">
            <button class="btn btn-danger">Delete</button>
        </a>
    </td>
</tr>
<?php } ?>

</table>

<br>



<br><br>

<?php if ($_SESSION['role'] === 'superadmin') { ?>
    <a href="../AssignRole/assign_role.php">
        <button class="btn btn-success">Go to Assign Role</button>
    </a>
<?php } ?>

</div>
</body>
</html>