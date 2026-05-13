<?php
include 'Database.php';

$email=$_POST['email'];
$password=$_POST['password'];
$confirmpw=$_POST['confirmpassword'];

if(empty($email) || empty($password) || empty($confirmpw)){
    die("ALL FIELDS ARE REQUIRED");
}

if($password !== $confirmpw){
    die("Password doesnt match");
}
if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
    die("Invalid email");
}
if(strlen($password)<6){
    die("Password must be at least of 6 characters");
}
$check="SELECT * FROM users WHERE email=:email";
$stmt=$pdo->prepare($check);
$stmt->bindparam(':email',$email);
$stmt->execute();

if($stmt->rowCount()>0){
    die("Email already exists");
}

$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
$sql="INSERT INTO users(email,password)VALUES(:email,:password)";
$stmt=$pdo->prepare($sql);
$stmt->bindparam(':email',$email);
$stmt->bindparam(':password',$hashedpassword);
$stmt->execute();

header("Location:LoginPage.html");
exit();
?>