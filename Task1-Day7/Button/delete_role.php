<?php
include "../Database/Database.php";

$user_id = $_GET['user_id'];
$role_id = $_GET['role_id'];

$sql = "DELETE FROM role_user WHERE user_id = :user_id AND role_id = :role_id";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':user_id' => $user_id,
    ':role_id' => $role_id
]);

header("Location: assign_role_users.php");
exit();
?>