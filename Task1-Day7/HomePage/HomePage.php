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


</body>
</html>