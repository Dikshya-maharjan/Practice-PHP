<?php
$pdo=new PDO('mysql:host=localhost;dbname=test','root','');
try{
    $pdo->beginTransaction();
    $name="Lays";
    $order_item=3;
    $payment=100;
    $insert="INSERT INTO orders(name,order_item,payment)VALUES(?,?,?)";
    $stmt=$pdo->prepare($insert);
    $stmt->execute([$name,$order_item,$payment]);
        // Change table name to force error OR remove this line in real use
    $paymentSql = "INSERT INTO payments(amount, status) VALUES(?, ?)";

    $paymentStmt = $pdo->prepare($paymentSql);
    $paymentStmt->execute([$payment, "SUCCESS"]);

    $pdo->commit();
    echo "Order and payment inserted successfully.";




}catch(Exception $e){
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}


?>