<?php
include '../Database/database.php';
session_start();

if (isset($_POST['submit'])) {

    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>
            alert('Fields should not be empty');
            window.location.href='loginpage.php';
        </script>";
        exit();
    }

    // get user by email + name
    $sql = "SELECT * FROM users 
            WHERE name = :name 
            AND email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $username,
        ':email' => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // verify password
    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../index.php");
        exit();

    } else {
        echo "<script>
            alert('Invalid login credentials');
            window.location.href='loginpage.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>
    <main>
        <h1>Log into your account</h1>
        <section>
        <form method="POST" action="loginpage.php">
            <label>Username</label><br/>
            <input type="text" name="name" placeholder='username'/><br/>
            <label>Email</label><br/>
            <input type="email" name="email" placeholder='email@gmail.com'/><br/>
            <label>Password</label><br/>
            <input type="password" name="password" /><br/>
            <input type="submit" name="submit" id="button" value="Login"/>
<p>Don't have an account?<a href="../Signup/signup.php">Sign up</a></p>            

        </form>

</section>
</main>
</body>
</html>