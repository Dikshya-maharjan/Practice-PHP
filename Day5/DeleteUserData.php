<?php
$pdo=new PDO('mysql:host=localhost;dbname=users','root','');
try{
    $id=1;
    $sql="DELETE FROM user WHERE id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$id]);
    echo "User data deleted successfully.";

}catch(Exception $e){
    echo "Error updating user data: " . $e->getMessage();
}
?>