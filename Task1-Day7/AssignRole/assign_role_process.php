<?php
session_start();
include '../Database/Database.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
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
$stmt->execute([
    ':user_id' => $user_id,
    ':role_id' => $role_id
]);

header("Location: assign_role_users.php");
exit();
?>