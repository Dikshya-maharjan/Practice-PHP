<?php
session_start();
include "../Database/Database.php";

if(!isset($_SESSION['email'])){
    header("Location: LoginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <!-- FIXED CSS -->
    <link rel="stylesheet" href="Homepage.css?v=2"/>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
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

<!-- MAIN CARD -->
<div class="mainContainer">

    <?php
    if(isset($_SESSION['message'])){
        echo "<div class='success'>" . $_SESSION['message'] . "</div>";
    }
    ?>

    <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>

    <p class="role">
        Logged in as:
        <span><?php echo htmlspecialchars($_SESSION['role']); ?></span>
    </p>

    <!-- ROLE DROPDOWN -->
    <select name="role">
        <?php foreach ($roles as $role) { ?>
            <option>
                <?php echo $role['role_name']; ?>
            </option>
        <?php } ?>
    </select>

    <!-- LOGOUT -->
    <a href="../Logout/logout.php"
       onclick="return confirm('Are you sure you want to logout?');">
        <button id="logoutBtn">Logout</button>
    </a>

</div>

</body>
</html>

<?php include "../Footer/footer.html"; ?>
