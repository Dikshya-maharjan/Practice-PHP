<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <form method="post">
        <label>Enter your name:</label>
        <input type="text" name="name">
        <br>
        <label>Enter your roll number:</label>
        <input type="number" name="roll_number">
       
        <br>
        <input type="submit" value="Submit">
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=$_POST['name'];
    $roll_number=$_POST['roll_number'];
    echo "<br>".htmlspecialchars("Form submitted successfully!");
    echo "<br>Student Name: " . htmlspecialchars($name) . "<br>";
    echo "Roll Number: " . htmlspecialchars($roll_number);
}

?>