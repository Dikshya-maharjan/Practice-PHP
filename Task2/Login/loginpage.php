<?php
include '../Database/database.php';
session_start();
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
        <form method="POST" action="/">
            <label>Username</label><br/>
            <input type="text" name="name" placeholder='name'/><br/>
            <label>Email</label><br/>
            <input type="email" name="email" placeholder='email@gmail.com'/><br/>
            <label>Password</label><br/>
            <input type="password" name="password" /><br/>
            <input type="submit" name="submit" id="login" value="Login"/>
<p>Don't have an account?<a href="../Signup/SignupPage.html">Sign up</a></p>            

        </form>

</section>
</main>
</body>
</html>