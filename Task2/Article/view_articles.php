<?php
include '../Database/database.php';
session_start();
//pagination
$limit = 3; // articles per page

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
//total articles
$total_sql = "SELECT COUNT(*) FROM articles";
$total_stmt = $pdo->prepare($total_sql);
$total_stmt->execute();
$total_articles = $total_stmt->fetchColumn();

$total_pages = ceil($total_articles / $limit);
$sql = "SELECT articles.*, 
        users.name
        FROM articles
        JOIN users ON users.id = articles.user_id
        ORDER BY articles.id ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Articles</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
<?php 
    include '../Header/header.php';
    ?>
<div class="container mt-5">

    <h2 class="mb-4">All Articles</h2>

    <a href="../index.php" class="btn btn-dark mb-3">
        <i class="bi bi-house"></i> Back to Dashboard
    </a>

    <?php foreach ($articles as $a): ?>

        <div class="card mb-3">
            <div class="card-body">

                <h5><?php echo $a['title']; ?></h5>

                <p><?php echo $a['content']; ?></p>

                <small>By: <?php echo $a['name']; ?></small>

                <hr>

                <!-- COMMENT FORM -->
                <form method="POST" action="add_comment.php" class="mt-2">

                    <input type="hidden" name="article_id" value="<?php echo $a['id']; ?>">

                    <textarea name="comment" class="form-control mb-2" placeholder="Write comment..." required></textarea>

                    <button type="submit" class="btn btn-primary btn-sm">
                        Comment
                    </button>

                </form>

                <!-- SHOW COMMENTS -->
                <div class="mt-3">

                <?php
                $cid = $a['id'];

                $csql = "SELECT comments.*, users.name
                         FROM comments
                         JOIN users ON users.id = comments.user_id
                         WHERE article_id = :id
                         ORDER BY comments.id DESC";

                $cstmt = $pdo->prepare($csql);
                $cstmt->execute([':id' => $cid]);
                $comments = $cstmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($comments as $c): ?>
                    <div class="border p-2 mb-2 bg-white">
                        <strong><?php echo $c['name']; ?>:</strong>
                        <?php echo $c['comment']; ?>
                    </div>
                <?php endforeach; ?>

                </div>

            </div>
        </div>

    <?php endforeach; ?>
    <!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center mt-4">

        <!-- Previous -->
        <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
        </li>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <li class="page-item <?php if($page >= $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
        </li>

    </ul>
</nav>

</div>

<?php 
    include '../Footer/footer.php';
    ?>
</body>
</html>