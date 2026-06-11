<?php
include '../Database/database.php';
// get articles posted betn time
$start = $_GET['start'] ?? '2026-01-01';
$end = $_GET['end'] ?? '2026-12-31';

$stmt = $pdo->prepare("
SELECT * FROM articles
WHERE created_at BETWEEN ? AND ?
");
$stmt->execute([$start, $end]);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles By Date</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
    include '../Header/header.php';
    ?>
<div class="container mt-5">

    <h2>Articles Between Dates</h2>

    <!-- filter form -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col">
            <input type="date" name="start" class="form-control">
        </div>
        <div class="col">
            <input type="date" name="end" class="form-control">
        </div>
        <div class="col">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['title'] ?></td>
                <td><?= $a['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
<?php
    include '../Footer/footer.php';
    ?>