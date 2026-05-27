<?php
session_start();
include_once "../Database/Database.php";

/* ======================================
   LOGIN CHECK
====================================== */
if (!isset($_SESSION['email'])) {
    header("Location:../Login/LoginPage.html");
    exit();
}

/* ======================================
   SUPERADMIN ONLY ACCESS
   (role_id = 1)
====================================== */
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    die("Access Denied");
}

/* ======================================
   UPDATE ROLE LOGIC
====================================== */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_id = $_POST['user_id'];
    $old_role_id = $_POST['old_role_id'];
    $new_role_id = $_POST['new_role_id'];

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