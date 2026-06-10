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
    <div class="border p-2 mt-2 bg-light">
        <strong><?php echo $c['name']; ?>:</strong>
        <?php echo $c['comment']; ?>
    </div>
<?php endforeach; ?>