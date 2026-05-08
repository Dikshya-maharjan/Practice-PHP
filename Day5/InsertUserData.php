<?php
$pdo=new PDO('mysql:host=localhost;dbname=users','root','');
try{
    $name="Dikshya";
    $email="dikshya@example.com";
    $sql="INSERT INTO user(name,email) VALUES(?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$name,$email]);
    echo "User data inserted successfully.";
}catch(Exception $e){
    echo "Error inserting user data: " . $e->getMessage();
}

?>