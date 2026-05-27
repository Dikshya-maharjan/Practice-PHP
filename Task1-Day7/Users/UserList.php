<?php
session_start();

include '../Database/Database.php';
include '../Header/Header.php';
include '../Navbar/navbar.php';
$page = basename($_SERVER['PHP_SELF']);
if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}

$sql = "SELECT
u.id as user_id,
u.email as user_name
FROM users u";

$stmt = $pdo->prepare($sql);

$stmt->execute();

// pagination
$limit=3;
//defines the no of limit to show on the page
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
$offset=($page-1)*$limit;

//total user
$totalStmt=$pdo->query("SELECT COUNT(*) FROM users");//counts the total no of records inside db table
$totalUsers=$totalStmt->fetchColumn();
$totalPages=ceil($totalUsers/$limit);

$pageSql="SELECT id as user_id, email as user_name
    FROM users
    LIMIT :limit OFFSET :offset";
    //:limit defines max size of data 
    // :offset define starting point of data
    $stmt1=$pdo->prepare($pageSql);
    $stmt1->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt1->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt1->execute();
$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="UserList.css">
    <link rel="stylesheet" href="../Header/header.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">
    <title>User List</title>
</head>
<body>
<?php
?>

<div class="page-content">

    <div class="table-container">

     <a href="../HomePage/HomePage.php" class="back-btn">
    <i class="bi bi-arrow-left"></i>
</a>


        <table class="table table-hover">
            <tr>
                <th>User ID</th>
                <th>User Email</th>
            </tr>

            <?php foreach($data as $row){ ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
            </tr>
            <?php } ?>
        </table>

    </div>

    <!-- pagination -->
    <div class="pagination">
      <nav aria-label="Page navigation example">
  <ul class="pagination">

    <!-- Previous -->
    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page - 1 ?>">
        Previous
      </a>
    </li>

    <!-- Page Numbers -->
    <?php for($i = 1; $i <= $totalPages; $i++) { ?>
      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>">
          <?= $i ?>
        </a>
      </li>
    <?php } ?>

    <!-- Next -->
    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page + 1 ?>">
        Next
      </a>
    </li>

  </ul>
</nav>

    </div>

</div>

<?php 
include '../Footer/footer.html'; 
?>
</body>
</html>

