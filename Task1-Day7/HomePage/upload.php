<?php
include '../Database/Database.php';

/*  DELETE IMAGE  */
// if (isset($_GET['delete_id'])) {

//     $delete_id = (int) $_GET['delete_id'];

//     // GET FILE PATH
//     $stmt = $pdo->prepare("SELECT file_path FROM images WHERE id = :id");
//     $stmt->execute([':id' => $delete_id]);
//     $image = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($image) {

//         // DELETE FILE FROM FOLDER
//         if (file_exists($image['file_path'])) {
//             unlink($image['file_path']);
//         }

//         // DELETE FROM DB
//         $delStmt = $pdo->prepare("DELETE FROM images WHERE id = :id");
//         $delStmt->execute([':id' => $delete_id]);
//     }

//     header("Location: ../HomePage/HomePage.php?page=" . ($_GET['page'] ?? 1));
//     exit();
// }

/*  UPLOAD IMAGE  */
if (isset($_POST['submit'])) {

    $check = getimagesize($_FILES['filetoUpload']['tmp_name']);

    if ($check !== false) {

        $fileName = basename($_FILES['filetoUpload']['name']);
        $targetDir = "../uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . time() . "_" . $fileName;

        if ($_FILES["filetoUpload"]["size"] <= 500000) {

            if (move_uploaded_file($_FILES['filetoUpload']['tmp_name'], $targetFile)) {

                $stmt = $pdo->prepare("
                    INSERT INTO images (file_name, file_path)
                    VALUES (?, ?)
                ");

                $stmt->execute([$fileName, $targetFile]);

                /* PREVENT REFRESH DUPLICATE UPLOAD */
                header("Location: ../HomePage/HomePage.php?uploaded=1&page=" . ($_GET['page'] ?? 1));
                exit();
            }
        }
    }
}

/*  PAGINATION  */
$limit = 3;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

/* TOTAL IMAGES */
$totalStmt = $pdo->query("SELECT COUNT(*) FROM images");
$totalImages = $totalStmt->fetchColumn();
$totalPages = ceil($totalImages / $limit);

/* PAGINATED IMAGES */
$stmt = $pdo->prepare("
    SELECT * FROM images
    ORDER BY id DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!--  UPLOAD FORM  -->
<link rel="stylesheet" href="./upload_image.css">

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="filetoUpload" required>
    <br><br>
    <button type="submit" name="submit">Upload</button>
</form>

<?php if (isset($_GET['uploaded'])) { ?>
    <p style="color:green;">Uploaded successfully!</p>
<?php } ?>

<hr>

<!--  DISPLAY IMAGES  -->
<h2>Uploaded Images</h2>

<div class="gallery">

<?php foreach ($images as $row) { ?>
    <div class="image-card">

        <img src="<?= $row['file_path'] ?>" alt="image">

        <p><?= htmlspecialchars($row['file_name']) ?></p>

        <a href="?delete_id=<?= $row['id'] ?>&page=<?= $page ?>"
           onclick="return confirm('Are you sure you want to delete this image?');"
           class="delete-btn">
            Delete
        </a>

    </div>
<?php } ?>

</div>

<!--  PAGINATION  -->
<div class="pagination">

<ul class="pagination">

    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
    </li>

    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php } ?>

    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
    </li>

</ul>

</div>