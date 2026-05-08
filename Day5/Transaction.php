<?php
$pdo=new PDO('mysql:host=localhost;dbname=test','root','');
try{
    $pdo->beginTransaction();
    $stmt1=$pdo->prepare('UPDATE accounts SET balance=balance-100 WHERE id=1');
    $stmt1->execute();
    $stmt2=$pdo->prepare('UPDATE accounts SET balance=balance+100 WHERE id=2');
    $stmt2->execute();
    $pdo->commit();
    echo "Transaction completed successfully.";
}catch(Exception $e){
        $pdo->rollback();
        echo "Transaction failed: " ;
}
?>