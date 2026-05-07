<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Check</title>
</head>
<body>
    <form method="post">
        <label>Enter your age:</label>
        <input type="number" name="age">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $age=$_POST['age'];
    if($age>18){
        echo "<br>".htmlspecialchars("You are eligible to vote.");
    }
    else{
        echo "<br>".htmlspecialchars("You are not eligible to vote.");
    }
}

?>