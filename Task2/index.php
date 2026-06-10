<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login/loginpage.php");
    exit();
}

// Session data
$name = $_SESSION['name'] ?? 'User';
$email = $_SESSION['email'] ?? '';
$role = $_SESSION['role'] ?? 'user';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<?php include 'Header/header.php'; ?>

<main class="container mt-5">

    <div class="text-center mb-4">
        <h1 class="text-primary">Blog System Dashboard</h1>
    </div>

    <h3>
        <i class="bi bi-person-circle"></i>
        Welcome, <?php echo htmlspecialchars($name); ?>
    </h3>

    <p>
        <i class="bi bi-envelope"></i>
        Email: <?php echo htmlspecialchars($email); ?>
    </p>

    <p>
        <strong>Role: <?php echo htmlspecialchars($role); ?></strong>
    </p>

    <hr>

    <h4 class="mb-3 text-center">
        Menu
    </h4>

    <div class="row">

        <!-- VIEW ARTICLES -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Article/view_articles.php" class="text-decoration-none">
                        View Articles
                    </a>
                </div>
            </div>
        </div>

        <!-- CREATE ARTICLE -->
        <?php if ($role == 'admin' || $role == 'author'): ?>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Article/create_articles.php" class="text-decoration-none">
                        Create Article
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- MANAGE USERS -->
        <?php if ($role == 'admin'): ?>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Roles/manage_users.php" class="text-decoration-none">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>

        <!-- MANAGE ROLES -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Roles/manage_roles.php" class="text-decoration-none">
                        Manage Roles
                    </a>
                </div>
            </div>
        </div>

        <!-- TASK 1 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Tasks/user_with_roles.php" class="text-decoration-none">
                        Users with Roles
                    </a>
                </div>
            </div>
        </div>

        <!-- TASK 2 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Tasks/top_user_roles.php" class="text-decoration-none">
                        Top User Roles
                    </a>
                </div>
            </div>
        </div>

        <!-- TASK 3 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Tasks/articles_with_comments.php" class="text-decoration-none">
                        Articles + Comments
                    </a>
                </div>
            </div>
        </div>

        <!-- TASK 4 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="Tasks/user_articles.php?user_id=1" class="text-decoration-none">
                        User Articles
                    </a>
                </div>
            </div>
        </div>

        <!-- TASK 5 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="./Tasks/articles_by_date.php" class="text-decoration-none">
                        Articles by Date
                    </a>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>

</main>

<?php include 'Footer/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>