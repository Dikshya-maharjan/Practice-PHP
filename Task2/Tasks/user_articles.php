<?php
include '../Database/database.php';
//get all articles of particular user
$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("
SELECT * FROM articles WHERE user_id = ?
");
$stmt->execute([$user_id]);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>User Articles</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['title'] ?></td>
                <td><?= $a['content'] ?></td>
                <td><?= $a['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>