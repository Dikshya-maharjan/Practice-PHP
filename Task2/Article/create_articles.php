<?php
include '../Database/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/loginpage.php");
    exit();
}

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {

        $sql = "INSERT INTO articles (title, content, user_id)
                VALUES (:title, :content, :user_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $user_id
        ]);

        header("Location: view_articles.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Create Article</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control"></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-success">
            Save
        </button>

        <a href="../index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>

    </form>

</div>

</body>
</html>