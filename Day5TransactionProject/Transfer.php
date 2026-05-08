<?php
require 'Database.php';
try{
    $pdo->beginTransaction();

    $senderID=4;
    $receiverID=4;
    $amount=1500;

    $stmtInsert=$pdo->prepare('UPDATE receiver SET balance=balance+? WHERE id=?');
    $stmtInsert->execute([$amount,$receiverID]);
    $stmtInsert1=$pdo->prepare('UPDATE sender SET balance=balance-? WHERE id=?');
    $stmtInsert1->execute([$amount,$senderID]);
    $pdo->commit();

}catch(Exception $e){
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}

?>