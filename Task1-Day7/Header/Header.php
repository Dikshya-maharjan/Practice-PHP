<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../Database/Database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /InternPHP/Task1-Day7/LoginPage.html");
    exit();
}

$currentPage = basename($_SERVER['PHP_SELF']);

/* 🔥 FETCH ROLES */
$roles = [];

$sql = "
    SELECT r.id, r.role_name
    FROM roles r
    JOIN role_user ru ON r.id = ru.role_id
    WHERE ru.user_id = :user_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':user_id' => $_SESSION['user_id']
]);

$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Document</title>
</head>
<body>
    
    <div class="header">
    
        <div class="header-left">
    
<img src="/InternPHP/Task1-Day7/Header/logo.png" alt="logo" class="logo">    
            <h3>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['email']); ?>
            </h3>
    
        </div>
    <div class="nav-right">

    <!-- ROLE DROPDOWN -->
    <div class="btn-group me-3">
        <?php
        if($currentPage=="HomePage.php"){ ?>
        
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
              href="/InternPHP/Task1-Day7/Homepage/Homepage.php?role_id=<?php echo $role['id']; ?>">
              
              <?php echo htmlspecialchars($role['role_name']); ?>
              
            </a>
        </li>
        
        <?php } ?>
        
        <?php } ?>
        
    </ul>
    <?php }?>

    </div>

 

</div>
 <div class="nav-right">
    <a href="../Logout/logout.php"
       onclick="return confirm('Are you sure you want to logout?');">
       
       <i class="bi bi-box-arrow-right"></i>
    </a>
</div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- add js to enbale dropdown of boostrsap -->
</body>
</html>