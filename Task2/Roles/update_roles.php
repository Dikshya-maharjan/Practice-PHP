<?php
include '../Database/database.php';
session_start();

/*  CHECK ADMIN  */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied");
}

/*  GET DATA  */
$user_id = $_POST['user_id'];
$role_id = $_POST['role_id'];

/*  CHECK IF ROLE ALREADY EXISTS  */
$check = $pdo->prepare("
    SELECT * FROM user_roles 
    WHERE user_id = ? AND role_id = ?
");
$check->execute([$user_id, $role_id]);

/*  INSERT ONLY IF NOT EXISTS  */
if ($check->rowCount() == 0) {

    $stmt = $pdo->prepare("
        INSERT INTO user_roles (user_id, role_id)
        VALUES (?, ?)
    ");
    $stmt->execute([$user_id, $role_id]);
}

/*  REDIRECT  */
header("Location: manage_roles.php?msg=updated");
exit();
?>