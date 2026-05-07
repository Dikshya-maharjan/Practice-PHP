<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
</head>
<body>
    <form method="post">
        <label>Enter first number:</label>
        <input type="number" name="num1">
        <br>
        <label>Enter second number:</label>
        <input type="number" name="num2">
        <br>
        <label>Select operation:</label>
        <select name="operation">
            <option value="+">Addition</option>
            <option value="-">Subtraction</option>
            <option value="*">Multiplication</option>
            <option value="/">Division</option>
        </select>
        <br>
        <input type="submit" value="Calculate">
</body>
</html>

<?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $num1=$_POST['num1'];
    $num2=$_POST['num2'];
    $operation=$_POST['operation'];
    $result=match($operation){
        "+"=>$num1+$num2,
        "-"=>$num1-$num2,
        "*"=>$num1*$num2,
        "/"=>$num1/$num2,
        default=>"Invalid operation",
    };
    echo "<br>".htmlspecialchars("Result : " . $result);
 }
 ?>