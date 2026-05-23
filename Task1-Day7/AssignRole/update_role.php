<?php

session_start();
include_once "../Database/Database.php";

if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $user_id = $_POST['user_id'];
    $old_role_id = $_POST['old_role_id'];
    $new_role_id = $_POST['new_role_id'];

    // UPDATE ROLE
   $sql = "
UPDATE role_user
SET role_id = :new_role_id
WHERE user_id = :user_id
AND role_id = :old_role_id
";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':new_role_id', $new_role_id);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':old_role_id', $old_role_id);

$stmt->execute();
    header("Location: assign_role_users.php");
    exit();
}
?>