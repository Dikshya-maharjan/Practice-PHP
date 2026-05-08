<?php
//create connection to database
$pdo=new PDO('mysql:host=localhost;dbname=test','root','');
try{
    //start transaction but tells dont permanently save changes until commit is called
    $pdo->beginTransaction();
    //id account define
    $id1=1;
    $id2=2;
    //deduct money from account 1 and add to account 2
    $stmt1=$pdo->prepare('UPDATE accounts SET balance=balance-100 WHERE id=?');
    $stmt1->execute([$id1]);
    $stmt2=$pdo->prepare('UPDATE wrong_table SET balance=balance+100 WHERE id=?');
    $stmt2->execute([$id2]);
    //most imp line where everything is permanently saved to database if any error occurs before this line then changes will not be saved and we can roll back to previous state
    $pdo->commit();
    echo "Transaction completed successfully.";

}catch(Exception $e){
    //if something goes wrong then we can roll back to previous state and changes will not be saved to database
    $pdo->rollBack();
    echo "Error updating user data: " . $e->getMessage();
}
?>