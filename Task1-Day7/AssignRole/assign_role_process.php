<?php
session_start();
include '../Database/Database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'superadmin') {
    die("Access Denied");
}

$user_id = $_POST['user_id'];
$role_id = $_POST['role_id'];

$sql = "
INSERT INTO role_user (user_id, role_id)
VALUES (:user_id, :role_id)
ON DUPLICATE KEY UPDATE role_id = VALUES(role_id)
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':role_id', $role_id);
$stmt->execute();

header("Location: assign_role.php");
exit();
?>