<?php
session_start();
include_once "../Database/Database.php";
include '../Header/header.php';

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
<link rel="stylesheet" href="../Header/header.css"
</head>

<body>

<div class="container mt-4">

<a href="../HomePage/HomePage.php" class="btn btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"> </i> 
</a>

<!-- FORM -->
<div class="card p-4">

<h4 id="title">Assign Role</h4>

<form method="POST" action="assign_role_process.php">

<select name="user_id" id="user_id" class="form-control mb-2">
<?php
 foreach($users as $u){
   ?>
<option value="<?= $u['id'] ?>"><?= $u['email'] ?>
</option>
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

<!-- TABLE -->
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
data-bs-toggle="modal"
data-bs-target="#editModal<?= $row['user_id'].'_'.$row['role_id'] ?>">
Edit
</button>

<!-- MODAL -->
<div class="modal fade"
id="editModal<?= $row['user_id'].'_'.$row['role_id'] ?>"
tabindex="-1">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <p>Do you want to edit this role?</p>

        <strong>User:</strong> <?= $row['user_name'] ?><br>
        <strong>Role:</strong> <?= $row['role_name'] ?>

      </div>

      <div class="modal-footer">

        <button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">
        Close
        </button>

        <button type="button"
        class="btn btn-primary"
        data-bs-dismiss="modal"
        onclick="fillEdit(
            <?= $row['user_id'] ?>,
            <?= $row['role_id'] ?>
        )">
        Update Role
        </button>

      </div>

    </div>

  </div>

</div>

<!-- DELETE -->
<a href="../Button/delete_role.php?user_id=<?= $row['user_id'] ?>&role_id=<?= $row['role_id'] ?>"
class="btn btn-danger"
onclick="return confirm('Delete?')">
Delete
</a>

</td>
</tr>

<?php } ?>

</table>

</div>



</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editRole(user, role){
    document.getElementById("user_id").value=user;
    document.getElementById("role_id").value=role;
  
//jaba edit btn click huncha jaba update role bhanera title aucha
    document.getElementById("title").innerText = "Update Role";
    //assign role
    document.getElementById("btn").innerText = "Update Role";
    document.getElementById("btn").classList.remove("btn-success");
    document.getElementById("btn").classList.add("btn-primary");

    window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>
<?php
include '../Footer/footer.html';
?>
</body>
</html>