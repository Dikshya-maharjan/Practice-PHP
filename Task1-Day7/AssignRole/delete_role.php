<?php
session_start();
include '../Database/Database.php';

if(!isset($_SESSION['role'])) die("Access Denied");

$user_id = $_GET['user_id'];
$role_id = $_GET['role_id'];

$stmt = $pdo->prepare("
DELETE FROM role_user
WHERE user_id=:user_id AND role_id=:role_id
");

$stmt->execute([
':user_id'=>$user_id,
':role_id'=>$role_id
]);

header("Location: ../AssignRole/assign_role.php");
exit();
?>