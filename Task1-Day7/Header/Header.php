<?php
include "../Database/Database.php";
if(!isset($_SESSION['email'])){
    //
    header("Location: LoginPage.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="styleshee" href="../HomePage/Homepage.css"/>
</head>
<body>
    <div class="mainContainer">

        <h2>Welcome <?php 
        
        echo $_SESSION['email'];?></h2>
    </div>

</body>
</html>