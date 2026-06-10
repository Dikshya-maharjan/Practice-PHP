<?php
include '../Database/database.php';
session_start();

/*  CHECK ADMIN LOGIN  */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Access denied";
    exit();
}

/*  FETCH USERS WITH MULTIPLE ROLES  */
$sql = "
SELECT 
    users.id,
    users.name,
    users.email,
    GROUP_CONCAT(roles.role_name SEPARATOR ', ') AS roles
FROM users
LEFT JOIN user_roles ON users.id = user_roles.user_id
LEFT JOIN roles ON roles.id = user_roles.role_id
GROUP BY users.id
ORDER BY users.id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*  FETCH ALL ROLES  */
$roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users Roles</title>
    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<?php include '../Header/header.php'; ?>

<div class="container mt-5">

    <h2 class="text-primary mb-4">
        <i class="bi bi-people-fill"></i> Manage Users & Roles
    </h2>

    <!-- TABLE -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Users List
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Assign New Role</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($users as $user): ?>
                    <tr>

                        <td><?php echo $user['id']; ?></td>

                        <td><?php echo htmlspecialchars($user['name']); ?></td>

                        <td><?php echo htmlspecialchars($user['email']); ?></td>

                        <td>
                            <?php echo $user['roles'] ? $user['roles'] : 'No Role'; ?>
                        </td>

                        <!-- Assign new role form -->
                        <td>
                            <form method="POST" action="update_roles.php">

                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                <select name="role_id" class="form-select" required>
                                    <option value="">Select role</option>

                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?php echo $role['id']; ?>">
                                            <?php echo $role['role_name']; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>

                                <button type="submit" class="btn btn-success btn-sm mt-2 w-100">
                                    Add Role
                                </button>

                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<!-- FOOTER -->
<?php include '../Footer/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>