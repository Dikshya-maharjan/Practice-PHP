<?php
include '../Database/database.php';
session_start();

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmpw = trim($_POST['confirmpassword']);

    // empty check
    if (empty($name) || empty($email) || empty($password) || empty($confirmpw)) {
        echo "<script>
            alert('All fields are required');
            window.location.href='signup.php';
        </script>";
        exit();
    }

    // password match
    if ($password !== $confirmpw) {
        echo "<script>
            alert('Password does not match');
            window.location.href='signup.php';
        </script>";
        exit();
    }

    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Invalid email');
            window.location.href='signup.php';
        </script>";
        exit();
    }

    // check duplicate email
    $check = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($check);
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo "<script>
            alert('Email already exists');
            window.location.href='signup.php';
        </script>";
        exit();
    }

    // hash password
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    // insert
    $sql = "INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashedpassword
    ]);

    $_SESSION['message'] = "Account created successfully";

    header("Location: ../Login/loginpage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Login/login.css">
    <title>Signup</title>
</head>
<body>
     <main>
        <h1>Create An account</h1>
        <section>
       <form method="POST" action="signup.php">

    <label>Username</label><br/>
    <input type="text" name="name" required><br/>

    <label>Email</label><br/>
    <input type="email" name="email" required><br/>

    <label>Password</label><br/>
    <input type="password" name="password" required><br/>

    <label>Confirm Password</label><br/>
    <input type="password" name="confirmpassword" required><br/>

    <input type="submit" name="submit" id="button" value="Sign up">

</form>
<p>ALready have an account?<a href="../Login/loginpage.php">Login Here</a></p>            

        </form>

</section>
</main>
</body>
</html>