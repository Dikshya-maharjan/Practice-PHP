<?php
session_start();
include_once "../Database/Database.php";

if($_POST){

    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    $edit_mode = $_POST['edit_mode'];

    if($edit_mode == 1){

        // UPDATE
        $sql = "UPDATE role_user 
                SET role_id = :role_id 
                WHERE user_id = :user_id";

    } else {

        // INSERT
        $sql = "INSERT INTO role_user(user_id, role_id)
                VALUES(:user_id, :role_id)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->execute();

    header("Location: assign_role_users.php");
    exit();
}
?>