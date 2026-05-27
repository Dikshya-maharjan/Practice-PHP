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
if ($user && password_verify($password, $user['password'])) {

    // get role id(s)
$sql = "SELECT role_id FROM role_user WHERE user_id = :user_id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user['id']]);
$role_id = $stmt->fetchColumn();

    // default role name
    // $role = "user";

    // if (!empty($roles)) {
        $sql = "SELECT role_name FROM roles WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $roles[0]]);
        $role = $stmt->fetchColumn();
    // }

    /* 🔥 IMPORTANT FIX */
    $_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['role_id'] = $role_id;

    $_SESSION['message'] = "Logged in Successfully";

    header("Location:/InternPHP/Task1-Day7/HomePage/HomePage.php");
    exit();

} else {
    echo "<script>
        alert('Invalid');
        window.location.href='Login/LoginPage.html';
    </script>";
    exit();
}

?>