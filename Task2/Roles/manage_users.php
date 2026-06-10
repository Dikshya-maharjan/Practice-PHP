<?php
include '../Database/database.php';
session_start();

// only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied");
}

// fetch users with roles (LEFT JOIN so users without role also show)
$sql = "
SELECT 
    users.id,
    users.name,
    users.email,
    roles.role_name
FROM users
LEFT JOIN user_roles ON users.id = user_roles.user_id
LEFT JOIN roles ON roles.id = user_roles.role_id
ORDER BY users.id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .role-btn {
            background: #3498db;
            color: white;
        }

        .back-btn {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
<?php
    include '../Header/header.php';
    ?>
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">
            <i class="bi bi-people-fill"></i> Manage Users
        </h1>

      
    </div>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            User Management
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover table-striped align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>

                    <td>
                        <?php echo htmlspecialchars($user['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($user['email']); ?>
                    </td>

                    <td>
                        <?php echo $user['role_name'] ?? 'No Role'; ?>
                    </td>

                    <td>
                        <a href="manage_roles.php"
                           class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i>
                            Change Role
                        </a>
                    </td>

                </tr>
                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>