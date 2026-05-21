<?php
session_start();

include "../Database/Database.php";

if(!isset($_SESSION['email'])){
    header("Location: LoginPage.html");
    exit();
}

/*
 ROLE SWITCH HANDLEr
ensures navbar updates when role changes
*/
if(isset($_GET['role_id'])){
    $_SESSION['role_id'] = $_GET['role_id'];

    header("Location: HomePage.php");
    exit();
}

include "../Header/Header.php";

$user_id = $_SESSION['user_id'] ?? null;

$roles = [];

/*
 GET ALL ROLES OF CURRENT USER
*/
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
}
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

<div class="navbar">

    <!-- LEFT SIDE MENU -->
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

    <!-- RIGHT SIDE LOGOUT -->
    <div class="nav-right">
        <a href="../Logout/logout.php"
           onclick="return confirm('Are you sure you want to logout?');">
           Logout
        </a>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="mainContainer">

<?php
if(isset($_SESSION['message'])){
    echo "<div class='success'>
            " . $_SESSION['message'] . "
          </div>";
}
?>

<h2>
    Welcome,
    <?php echo $_SESSION['email']; ?>
</h2>

<p class="role">
    Logged in as:
    <span>
        <?php echo htmlspecialchars($_SESSION['role']); ?>
    </span>
</p>

<!-- ROLE DROPDOWN -->
<div class="btn-group">

  <button type="button"
          class="btn btn-info dropdown-toggle"
          data-bs-toggle="dropdown"
          aria-expanded="false">

    Select Role

  </button>

  <ul class="dropdown-menu">

    <?php if(empty($roles)) { ?>

      <li>
        <span class="dropdown-item text-muted">
            No roles assigned
        </span>
      </li>

    <?php } else { ?>

      <?php foreach($roles as $role) { ?>

        <li>
          <a class="dropdown-item"
             href="?role_id=<?php echo $role['id']; ?>">

            <?php echo htmlspecialchars($role['role_name']); ?>

          </a>
        </li>

      <?php } ?>

    <?php } ?>

  </ul>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- add js to enbale dropdown of boostrsap -->
</body>
</html>

<?php include "../Footer/footer.html"; ?>