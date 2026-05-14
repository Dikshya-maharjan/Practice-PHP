<?php
session_start();
include "../Database/Database.php";
include "../Header/Header.php";
if(!isset($_SESSION['email'])){
    //
    header("Location: LoginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<link rel="stylesheet" href="Homepage.css"/>
<body>
    <div class="mainContainer">

        
        <?php
        if(isset($_SESSION['message'])){
            //
            echo "<p style='color:green'>".$_SESSION['message']."</p>";
        }
        ?>
        
        <p>You are logged in as: <?php echo $_SESSION['email']; ?></p>
        <p> You logged in as :
            <span style="color:red;">
                <?php echo htmlspecialchars($_SESSION['role']); ?>
            </span>
        </p>
        <?php 
        if ($_SESSION['role'] === 'superadmin') { ?>
            <a href="../AssignRole/assign_role.php">
                <button id="assignBtn">Go to Assign Role</button>
            </a>
        <?php } ?>
        <!-- display menu -->
        
        <h3>Menus</h3>
         <?php
         if(!empty($_SESSION['role_id'])){
        $sql = "
        SELECT m.id,m.name
        FROM menus m
        JOIN menu_role mr ON m.id = mr.menu_id
        
        WHERE mr.role_id = :role_id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':role_id', $_SESSION['role_id']);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($menus) {
                foreach ($menus as $menu){
echo "<a href='dashboard.php?menu_id={$menu['id']}'>
        <button id='menuBtn'>{$menu['name']}</button>
      </a>";                }
            } else {
                echo "No menus found for this role.";
            }
        
        }
        ?>
        <br>
        <a href="../Logout/logout.php" onclick="return confirm('Are you sure you want to logout?');">
            <button type="button" id="logoutBtn">Logout</button>
        </a>
    </div>

</body>
</html>