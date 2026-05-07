<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate</title>
</head>
<body>
    <form method="post">
        <label>Enter first number:</label>
        <input type="number" name="num1">
        <br>
        <label>Enter second number:</label>
        <input type="number" name="num2">
        <br>
        
        <input type="submit" value="Calculate">
    
</body>
</html>
<?php
$num1=$_POST['num1'];
$num2=$_POST['num2'];
$sum=$num1+$num2;
$sub=$num1-$num2;
$multiply=$num1*$num2;

echo "<h2>Results:</h2>";
echo "The sum of " . $num1 . " and " . $num2 . " is: " . $sum;
echo "<br>The difference of " . $num1 . " and " . $num2 . " is: " . $sub;
echo "<br>The product of " . $num1 . " and " . $num2 . " is: " . $multiply;  
 
?>