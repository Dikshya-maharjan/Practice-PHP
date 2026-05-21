<?php
session_start();

include_once "../Database/Database.php";

if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}

$menu_id = $_GET['menu_id'] ?? null;

$editData = null;

if(isset($_GET['edit']) && isset($_GET['user_id']) && isset($_GET['role_id'])){

    $user_id = $_GET['user_id'];
    $role_id = $_GET['role_id'];

    $editSql = "SELECT 
        u.id AS user_id,
        u.email AS user_name,
        r.id AS role_id,
        r.role_name
    FROM role_user ru
    JOIN users u ON ru.user_id = u.id
    JOIN roles r ON ru.role_id = r.id
    WHERE ru.user_id = :user_id
    AND ru.role_id = :role_id
    ";

    $editStmt = $pdo->prepare($editSql);
    $editStmt->bindParam(':user_id', $user_id);
    $editStmt->bindParam(':role_id', $role_id);
    $editStmt->execute();

    $editData = $editStmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['update_role'])){

    $user_id = $_POST['user_id'];
    $old_role_id = $_POST['old_role_id'];
    $new_role_id = $_POST['new_role_id'];

    $updateSql = "
    UPDATE role_user
    SET role_id = :new_role_id
    WHERE user_id = :user_id
    AND role_id = :old_role_id
    ";

    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':new_role_id', $new_role_id);
    $updateStmt->bindParam(':user_id', $user_id);
    $updateStmt->bindParam(':old_role_id', $old_role_id);
    $updateStmt->execute();

    header("Location: assign_role_users.php?menu_id=$menu_id");
    exit();
}

$roleSql = "SELECT * FROM roles";
$roleStmt = $pdo->prepare($roleSql);
$roleStmt->execute();
$roles = $roleStmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "
SELECT 
    u.id AS user_id,
    u.email AS user_name,
    r.id AS role_id,
    r.role_name
FROM role_user ru
JOIN users u ON ru.user_id = u.id
JOIN roles r ON ru.role_id = r.id
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="assignrole.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<title>Access Role</title>
</head>

<body>

<div class="table-container">

<a href="../HomePage/HomePage.php" class="back-btn">
<button class="btn btn-lg">
<i class="bi bi-arrow-left-square-fill"></i>
</button>
</a>

<?php if($editData){ ?>

<div class="card p-3 mb-4">

<h4>Edit Role</h4>

<form method="POST">

<input type="hidden" name="user_id" value="<?php echo $editData['user_id']; ?>">
<input type="hidden" name="old_role_id" value="<?php echo $editData['role_id']; ?>">

<div class="mb-3">
<label>User</label>
<input type="text" class="form-control" value="<?php echo $editData['user_name']; ?>" readonly>
</div>

<div class="mb-3">
<label>Select New Role</label>

<select name="new_role_id" class="form-control">

<?php foreach($roles as $role){ ?>

<option value="<?php echo $role['id']; ?>"
<?php if($role['id'] == $editData['role_id']) echo "selected"; ?>>

<?php echo $role['role_name']; ?>

</option>

<?php } ?>

</select>

</div>

<button type="submit" name="update_role" class="btn btn-success">
Update Role
</button>

</form>

</div>

<?php } ?>

<h2>Access Role</h2>

<table class="table table-hover" border="1">

<tr>
<th>User ID</th>
<th>User Name</th>
<th>Role ID</th>
<th>Role Name</th>
<th>Action</th>
</tr>

<?php foreach ($data as $row) { ?>

<tr>

<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['user_name']; ?></td>
<td><?php echo $row['role_id']; ?></td>
<td><?php echo $row['role_name']; ?></td>

<td>

<a href="?menu_id=<?php echo $menu_id; ?>&edit=1&user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>"
onclick="return confirm('Edit this role?');">
<button class="btn btn-primary">Edit</button>
</a>

<a href="../Button/delete_role.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id']; ?>"
onclick="return confirm('Delete this role?');">

<button class="btn btn-danger">Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

<div class="card p-3 mb-3 mt-4">

<h5>Send Message</h5>

<form method="POST">

<div class="mb-3">
<textarea name="message" class="form-control" rows="4" placeholder="Type your message here..." required></textarea>
</div>

<button type="submit" class="btn btn-primary">
Send Message
</button>

</form>

</div>

<?php if ($_SESSION['role'] === 'superadmin') { ?>

<a href="../AssignRole/assign_role.php">
<button class="btn btn-success">
Go to Assign Role
</button>
</a>

<?php } ?>

</div>

</body>
</html>