<?php
session_start();
include_once "../Database/Database.php";

if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}

$users = $pdo->query("SELECT id,email FROM users")->fetchAll(PDO::FETCH_ASSOC);
$roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);

$data = $pdo->query("
SELECT u.id user_id, u.email user_name, r.id role_id, r.role_name
FROM role_user ru
JOIN users u ON ru.user_id=u.id
JOIN roles r ON ru.role_id=r.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container mt-4">
<a href="../HomePage/HomePage.php" class="btn btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"> </i> 
</a>

<div class="card p-4">

<h4 id="title">Assign Role</h4>

<form method="POST" action="assign_role_process.php">

<select name="user_id" id="user_id" class="form-control mb-2">
<?php foreach($users as $u){ ?>
<option value="<?= $u['id'] ?>"><?= $u['email'] ?></option>
<?php } ?>
</select>

<select name="role_id" id="role_id" class="form-control mb-2">
<?php foreach($roles as $r){ ?>
<option value="<?= $r['id'] ?>"><?= $r['role_name'] ?></option>
<?php } ?>
</select>

<button class="btn btn-success" id="btn">
Assign Role
</button>

</form>

</div>

<br>

<table class="table table-hover">
<tr>
<th>User</th><th>Role</th><th>Action</th>
</tr>

<?php foreach($data as $row){ ?>

<tr>
<td><?= $row['user_name'] ?></td>
<td><?= $row['role_name'] ?></td>

<td>

<button class="btn btn-primary"
onclick="editRole(<?= $row['user_id'] ?>, <?= $row['role_id'] ?>)">
Edit
</button>

<a href="delete_role.php?user_id=<?= $row['user_id'] ?>&role_id=<?= $row['role_id'] ?>"
class="btn btn-danger"
onclick="return confirm('Delete?')">
Delete
</a>

</td>
</tr>

<?php } ?>

</table>

</div>



</body>
</html>