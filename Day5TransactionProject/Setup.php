<?php
require 'Database.php';
try{
    $pdo->beginTransaction();
    $pdo->prepare("INSERT INTO receiver(balance)VALUES(?)")->execute([1000]);
    $pdo->prepare("INSERT INTO sender(balance)VALUES(?)")->execute([2000]);
    $pdo->commit();
    echo "Setup completed successfully.";

}
catch(Exception $e){
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}   
?>