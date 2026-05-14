<?php
session_start();
include "../Database/Database.php";
if(!isset($_SESSION['email'])){
    //
    header("Location: LoginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<h2>Welcome Home</h2>

<?php
if(isset($_SESSION['message'])){
    //
    echo "<p style='color:green'>".$_SESSION['message']."</p>";
}
?>

<p>You are logged in as: <?php echo $_SESSION['email']; ?></p>
<p> You logged in as :<?php echo $_SESSION['role'];?></p>
<?php 
if ($_SESSION['role'] === 'superadmin') { ?>
    <a href="../AssignRole/assign_role.php">
        <button>Go to Assign Role</button>
    </a>
<?php } ?>
<!-- display menu -->

<h3>Menus</h3>
 <?php
 if(!empty($_SESSION['role_id'])){
$sql = "
SELECT m.name
FROM menus m
JOIN menu_role mr ON m.id = mr.menu_id

WHERE mr.role_id = :role_id
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':role_id', $_SESSION['role_id']);
$stmt->execute();
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($menus) {
        foreach ($menus as $menu){
            echo "<li>{$menu['name']}</li>";
        }
    } else {
        echo "No menus found for this role.";
    }

}
?>

<a href="../Logout/logout.php" onclick="return confirm('Are you sure you want to logout?');">
    <button type="button">Logout</button>
</a>
</body>
</html>