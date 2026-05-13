<?php
session_start();
include 'Database.php';
//get form data
$email=$_POST['email'];
$password=$_POST['password'];

if(empty($email) || empty($password)){
    echo "<script>
    alert('Email and Password should not be empty');
    window.location.href='LoginPage.html';
    </script>";
}

$sql="SELECT * FROM users WHERE email=:email";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":email",$email);
$stmt->execute();
$user=$stmt->fetch(PDO::FETCH_ASSOC);//fetches user data
if($user && password_verify($password,$user['password'])){
    //$password->what users inputs and $user['passwor'] is what stored in database
        $_SESSION['email']=$user['email'];
        $_SESSION['message']="Logged in Successfully";
    
        header("Location:/internphp/task1-day7/HomePage.php");
        exit();

       
    }else{
        echo "<script>
            alert('Invalid');
            window.location.href='LoginPage.html';
        </script>";
    }



?>