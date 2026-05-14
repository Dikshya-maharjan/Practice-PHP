<?php
include '../Database/Database.php';

$email=$_POST['email'];
$password=$_POST['password'];
$confirmpw=$_POST['confirmpassword'];

if(empty($email) || empty($password) || empty($confirmpw)){
    echo "<script>
        alert('ALL FIELDS ARE REQUIRED');
        window.location.href='SignupPage.html';
    </script>";
}

if($password !== $confirmpw){
        echo "<script>
        alert('Password doesnt match');
        window.location.href='SignupPage.html';
        </script>";
}
if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
        echo "<script>
        alert('Invalid Email');
        window.location.href='../Signup/SignupPage.html';
        </script>";
}
if(strlen($password)<6){
    echo "<script>
    alert('Password must contain at least 6 letters');
    window.location.href='../Signup/SignupPage.html';
    <script>";
}
$check="SELECT * FROM users WHERE email=:email";
$stmt=$pdo->prepare($check);
$stmt->bindparam(':email',$email);
$stmt->execute();

if($stmt->rowCount()>0){
        echo "<script>
        alert('Email already exists');
        window.location.href='../Signup/SignupPage.html';

        </script>
        ";
}

$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
$sql="INSERT INTO users(email,password)VALUES(:email,:password)";
$stmt=$pdo->prepare($sql);
$stmt->bindparam(':email',$email);
$stmt->bindparam(':password',$hashedpassword);
$stmt->execute();
$_SESSION['message'] = "Account created successfully! Please login.";

header("Location:../Login/LoginPage.html");
exit();
?>