<?php
session_start();

include '../Database/Database.php';

if(!isset($_SESSION['email'])){
    header("Location:../Login/LoginPage.html");
    exit();
}

$email = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user_id = $stmt->fetchColumn();

/* DEFAULT VALUES */
$roles = [];
$currentRole = "Select Role";

/* GET ALL ROLES */
if($user_id){

    $sql = "
    SELECT r.id, r.role_name
    FROM roles r
    JOIN role_user ru ON r.id = ru.role_id
    WHERE ru.user_id = :user_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* SET CURRENT ROLE */
    if(!empty($_SESSION['role_id'])){
        foreach($roles as $r){
            if($r['id'] == $_SESSION['role_id']){
                $currentRole = $r['role_name'];
                break;
            }
        }
    }
}

include '../Header/Header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <link rel="stylesheet" href="/InternPHP/Task1-Day7/Homepage/Homepage.css">
    <link rel="stylesheet" href="/InternPHP/Task1-Day7/Header/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR (UNCHANGED) -->
<div class="navbar">

    <div class="nav-left">
        <?php
        if(!empty($_SESSION['role_id'])) {

            $sql = "
            SELECT m.id, m.name
            FROM menus m
            JOIN menu_role mr ON m.id = mr.menu_id
            WHERE mr.role_id = :role_id
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':role_id', $_SESSION['role_id']);
            $stmt->execute();

            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($menus as $menu) {

                $link = match($menu['id']) {
                    1 => '../Dashboard/Dashboard.php',
                    2 => '../AssignRole/assign_role_users.php',
                    3 => '../Users/UserList.php',
                    4 => '../Report/Reports.php',
                    default => '#'
                };

                echo "<a href='$link?menu_id={$menu['id']}'>{$menu['name']}</a>";
            }
        }
        ?>
    </div>

    <div class="nav-right">
        <a href="../Logout/logout.php"
           onclick="return confirm('Are you sure you want to logout?');">
            <i class="bi bi-box-arrow-right"></i>
        </a>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="mainContainer">

<!-- ROLE DROPDOWN (FIXED) -->

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php include "../Footer/footer.html"; ?>