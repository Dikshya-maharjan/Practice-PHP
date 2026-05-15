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
    <link rel="stylesheet" href="UserList.css">
    <title>User List</title>
</head>
<body>
    <div class="table-Container">

        <table border="1" id="table">
        
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
        <a href="../HomePage/HomePage.php">
        <button>Back</button>
        </a>
    </div>

</body>
</html>