<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../Database/Database.php";

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="/InternPHP/Task1-Day7/Navbar/navbar.css">

<div class="navbar">

    <div class="nav-left">

        <?php
        if (!empty($_SESSION['role_id'])) {

            $sql = "
                SELECT m.id, m.name
                FROM menus m
                JOIN menu_role mr ON m.id = mr.menu_id
                WHERE mr.role_id = :role_id
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':role_id' => $_SESSION['role_id']
            ]);

            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($menus as $menu) {

                $link = match ($menu['id']) {
                    1 => '../Dashboard/Dashboard.php',
                    2 => '../AssignRole/assign_role_users.php',
                    3 => '../Users/UserList.php',
                    4 => '../Report/Reports.php',
                    default => '#'
                };

                $icon = match ($menu['id']) {
                    1 => "bi-house",
                    2 => "bi-person-badge",
                    3 => "bi-people",
                    4 => "bi-bar-chart",
                    default => "bi-circle"
                };

                $isActive = '';

                if (!isset($_GET['menu_id']) && $menu['id'] == 1) {
                    // DEFAULT DASHBOARD ACTIVE
                    $isActive = 'active';
                } elseif (isset($_GET['menu_id']) && $_GET['menu_id'] == $menu['id']) {
                    // CLICKED MENU ACTIVE
                    $isActive = 'active';
                }
        ?>

        <a href="<?= $link ?>?menu_id=<?= $menu['id'] ?>"
           class="nav-link <?= $isActive ?>">

            <i class="bi <?= $icon ?>"></i>
            <span><?= htmlspecialchars($menu['name']) ?></span>

        </a>

        <?php
            }
        }
        ?>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>