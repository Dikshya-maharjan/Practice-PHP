<?php
include '../Database/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/loginpage.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM articles WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header("Location: view_articles.php");
exit();
?>