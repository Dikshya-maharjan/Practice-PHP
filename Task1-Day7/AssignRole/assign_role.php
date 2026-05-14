<?php
session_start();
include '../Database/Database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    echo "<script>
    alert('Access Denied');
    window.location.href='Loginpage.php'; 
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form method="post" action="../AssignRole/assign_role_process.php">
        <h2>Assign Role</h2>
        <label>Select User</label>
        <select name="user_id">
            <!-- php code add here to connect with database -->
             <?php
                //read email from users table
                    $sql="SELECT id,email FROM users";
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute();
                    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    //use foreach loop to get data from the database
                    foreach($users as $user){
                            $id = $user['id'];

                            $email = $user['email'];
                        echo "<option value='$id'>$email</option>";
                        //{} because it is inside string
                    }
             ?>
</select>
<br><br>
<!-- //select role -->
<label>Select Role</lable>
<select name='role_id'>
    <?php
    //read data from roles
     $sql="SELECT * FROM roles";
     $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $roles=$stmt->fetchall(PDO::FETCH_ASSOC);
    //use foreach loop to get data from database
    foreach($roles as $role){
            $id = $role['id'];
            $name=$role['role_name'];
        echo "<option value='$id'>
            $name       
             </option>";
    }
     ?>
</select>
    <button type="submit">Assign Role</button>
</form>
</body>
</html>