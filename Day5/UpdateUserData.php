<?php
$pdo=new PDO('mysql:host=localhost;dbname=users','root','');
try{
    $id=1;
    $email="ramu@gmail.com";
    $sql="UPDATE user SET email=? WHERE id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$email,$id]);
    echo "User data updated successfully.";

}catch(Exception $e){
    echo "Error updating user data: " . $e->getMessage();
}
?>