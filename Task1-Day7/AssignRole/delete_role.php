<?php
session_start();
include '../Database/Database.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    die("Access Denied");
}

if (!isset($_GET['user_id']) || !isset($_GET['role_id'])) {
    die("Invalid Request");
}

$user_id = $_GET['user_id'];
$role_id = $_GET['role_id'];

$stmt = $pdo->prepare("
DELETE FROM role_user
WHERE user_id = :user_id
AND role_id = :role_id
");

$stmt->execute([
    ':user_id' => $user_id,
    ':role_id' => $role_id
]);

// 🔥 FIXED PATH (IMPORTANT)
header("Location: ../AssignRole/assign_role_users.php");
exit();
?>