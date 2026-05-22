<?php
session_start();
include '../Database/Database.php';
//get form data
$email=$_POST['email'];
$password=$_POST['password'];

if(empty($email) || empty($password)){
    echo "<script>
    alert('Email and Password should not be empty');
    window.location.href='LoginPage.html';
    </script>";
    exit();
}

$sql="SELECT * FROM users WHERE email=:email";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":email",$email);
$stmt->execute();
$user=$stmt->fetch(PDO::FETCH_ASSOC);//fetches user data
if($user && password_verify($password,$user['password'])){
    //$password->what users inputs and $user['password'] is what stored in database
    
    //get role id
$sql = "SELECT role_id FROM role_user WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user['id']);
$stmt->execute();
    $role_id = $stmt->fetchColumn();

    /* GET ROLE NAME (SAFE) */
    $role = "user";

  
    //get role name
    if($role_id){

        $sql="SELECT role_name FROM roles WHERE id=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':id',$role_id);
        $stmt->execute();
        $role=$stmt->fetchColumn();
    }
        $_SESSION['email']=$user['email'];
        $_SESSION['role']=$role;
        $_SESSION['role_id']=$role_id;
        $_SESSION['message']="Logged in Successfully";

        header("Location:/internphp/task1-day7/HomePage/HomePage.php");
        
       
    }else{
        echo "<script>
            alert('Invalid');
            window.location.href='Login/LoginPage.html';
        </script>";
        exit();
    }
 

?>