<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "../Database/Database.php";
?>

<div class="navbar">
    <div class="nav-left">
        <?php

        if (empty($_SESSION['role_id'])) {
            echo "<p style='color:red;'> Role ID is not set in session. Please login again.</p>";
        } else {
            $sql = "
                SELECT m.id, m.name 
                FROM menus m
                JOIN menu_role mr ON m.id = mr.menu_id
                WHERE mr.role_id = :role_id
                ORDER BY m.id
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':role_id' => $_SESSION['role_id']]);
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if (empty($menus)) {
                echo "<p style='color:red;'>No menus found for role_id = " . $_SESSION['role_id'] . "</p>";
            }

            foreach ($menus as $menu) {
                $link = match ($menu['id']) {
                    1 => '../HomePage/HomePage.php',
                    2 => '../AssignRole/assign_role_users.php',
                    3 => '../Users/UserList.php',
                    4 => '../Report/Reports.php',
                    default => '#'
                };
        ?>
       <?php
$currentPage = basename($_SERVER['PHP_SELF']);

$activeMenuId = $_GET['menu_id'] ?? 1;
?>

<a href="<?= $link ?>?menu_id=<?= $menu['id'] ?>"
   class="nav-link <?= ($menu['id'] == $activeMenuId) ? 'active' : '' ?>">

    <i class="bi bi-house"></i>

    <span><?= htmlspecialchars($menu['name']) ?></span>
</a>
        <?php
            }
        }
        ?>
    </div>
</div>