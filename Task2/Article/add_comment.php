<?php
include '../Database/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/loginpage.php");
    exit();
}

if (isset($_POST['comment'])) {

    $article_id = $_POST['article_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    if (!empty($comment)) {

        $sql = "INSERT INTO comments (article_id, user_id, comment)
                VALUES (:article_id, :user_id, :comment)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':article_id' => $article_id,
            ':user_id' => $user_id,
            ':comment' => $comment
        ]);
    }
}

header("Location: view_articles.php");
exit();
?>