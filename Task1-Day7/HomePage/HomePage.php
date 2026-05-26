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
    include "../Header/Header.php";
    include "../Navbar/navbar.php";
    ?>

<!DOCTYPE html>
<html>
    
    <head>

    <title>Home</title>

    <link rel="stylesheet" href="/InternPHP/Task1-Day7/Homepage/Homepage.css">
    <link rel="stylesheet" href="../Header/header.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>



<!-- MAIN CONTENT -->
<div class="mainContainer">
<!-- <?php
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
</p>-->

<!-- ROLE DROPDOWN -->


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- add js to enbale dropdown of boostrsap -->
</body>
</html>

<?php include "../Footer/footer.html"; ?>