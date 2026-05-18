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
    <title>User List</title>
</head>
<body>
    <div class="table-Container">

        <a href="../HomePage/HomePage.php" class="back-btn">
       <button class="btn btn-lg"> <i class="bi bi-arrow-left-square-fill"></i></button>
        </a>
        <table border="1" class="table table-hover">
        
        <tr id="row">
            <th id="head">User ID</th>
            <th id="head">User Email</th>
        </tr>
        
        <?php foreach($data as $row){ ?>
        
        <tr>
            <td ><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
        </tr>
        
        <?php } ?>
        
        
        </table>
        <br><br>
       
    </div>

</body>
</html>