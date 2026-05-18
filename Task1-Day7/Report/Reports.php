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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../Users/UserList.css">
    <title>Document</title>
</head>
<body>
    <div class="table_container">

        <a href="../HomePage/HomePage.php" class="back-btn">
       <button class="btn btn-lg"> <i class="bi bi-arrow-left-square-fill"></i></button>
        </a>
        <h2>Access Role </h2>
        <table border="1" class="table table-hover">
        <tr>
            <th>User Name</th>
            <th>Role Name</th>
        </tr>
    
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['role_name']; ?></td>
            </tr>
        <?php } ?>
    </table>
  
    </div>

</body>
</html> 