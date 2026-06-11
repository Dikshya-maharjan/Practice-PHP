<?php
include '../Database/database.php';
//get users with highest no of roles
$sql = "
SELECT 
    users.name,
    COUNT(user_roles.role_id) AS total_roles
FROM users
LEFT JOIN user_roles ON users.id = user_roles.user_id
GROUP BY users.id
ORDER BY total_roles DESC
LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top User Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>User with Highest Roles</h2>

    <div class="card p-4 mt-3">
        <h4>Name: <?= $user['name'] ?></h4>
        <h4>Total Roles: <?= $user['total_roles'] ?></h4>
    </div>
</div>

</body>
</html>