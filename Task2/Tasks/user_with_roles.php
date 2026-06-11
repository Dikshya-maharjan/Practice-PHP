<?php
include '../Database/database.php';
session_start();
// get all user with their roles
$sql = "
SELECT 
    users.id,
    users.name,
    users.email,
    COALESCE(GROUP_CONCAT(roles.role_name SEPARATOR ', '), 'No Role') AS roles
FROM users
LEFT JOIN user_roles ON users.id = user_roles.user_id
LEFT JOIN roles ON roles.id = user_roles.role_id
GROUP BY users.id, users.name, users.email
";

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users with Roles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">

<!-- HEADER -->
<?php include '../Header/header.php'; ?>

<!-- MAIN CONTENT -->
<div class="container mt-5 mb-5">
    <h2 class="mb-4">All Users with Roles</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']) ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['roles']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- FOOTER -->
<?php include '../Footer/footer.php'; ?>>

</body>
</html>