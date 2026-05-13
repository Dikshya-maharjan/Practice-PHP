<?php
session_start();

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
<?php if ($_SESSION['role'] === 'superadmin') { ?>
    <a href="../AssignRole/assign_role.php">
        <button>Go to Assign Role</button>
    </a>
<?php } ?>

</body>
</html>