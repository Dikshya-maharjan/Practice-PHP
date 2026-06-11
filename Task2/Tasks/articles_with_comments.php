<?php
include '../Database/database.php';
// get all articles with comment
$sql = "
SELECT 
    articles.id,
    articles.title,
    GROUP_CONCAT(comments.comment SEPARATOR ' | ') AS comments
FROM articles
LEFT JOIN comments ON articles.id = comments.article_id
GROUP BY articles.id
ORDER BY articles.id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles with Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Articles with Comments</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Comments</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['title'] ?></td>
                <td><?= $a['comments'] ? $a['comments'] : 'No Comments' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>