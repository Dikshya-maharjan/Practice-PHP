<?php
include '../Database/database.php';
session_start();

// only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Access denied";
    exit();
}

// get users
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

// get roles
$roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Roles</title>
</head>
<body>

<h1>Admin - Assign Roles</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Email</th>
        <th>Assign Role</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <form method="POST" action="update_role.php">
            <td>
                <?php echo $user['name']; ?>
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            </td>

            <td><?php echo $user['email']; ?></td>

            <td>
                <select name="role_id">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id']; ?>">
                            <?php echo $role['role_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <td>
                <button type="submit">Update</button>
            </td>
        </form>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>