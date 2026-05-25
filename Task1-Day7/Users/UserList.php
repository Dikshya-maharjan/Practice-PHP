<?php
session_start();

include '../Database/Database.php';
if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}


$sql = "SELECT
u.id as user_id,
u.email as user_name
FROM users u";

$stmt = $pdo->prepare($sql);

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
    <link rel="stylesheet" href="UserList.css">
    <link rel="stylesheet" href="../Header/header.css">
    <title>User List</title>
</head>
<body>
<?php include '../Header/Header.php'; ?>


<div class="page-content">

    <div class="table-container">

     <a href="../HomePage/HomePage.php" class="back-btn">
    <i class="bi bi-arrow-left"></i>
</a>


        <table class="table table-hover">
            <tr>
                <th>User ID</th>
                <th>User Email</th>
            </tr>

            <?php foreach($data as $row){ ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

<?php 
include '../Footer/footer.html'; 
?>
</body>
</html>

