<?php
include '../Database/database.php';
session_start();

if (isset($_POST['submit'])) {

    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //  validation
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>
                alert('All fields are required');
                window.location.href='loginpage.php';
              </script>";
        exit();
    }

    // Find user
    $sql = "SELECT * FROM users
            WHERE name = :name
            AND email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $username,
        ':email' => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {

        // Get user role
        $roleSql = "
            SELECT r.role_name
            FROM roles r
            INNER JOIN user_roles ur
                ON r.id = ur.role_id
            WHERE ur.user_id = :user_id
            LIMIT 1
        ";

        $roleStmt = $pdo->prepare($roleSql);
        $roleStmt->execute([
            ':user_id' => $user['id']
        ]);

        $role = $roleStmt->fetchColumn();

        if (!$role) {
            $role = 'user';
        }

        // Create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $role;

        header("Location: ../index.php");
        exit();

    } else {

        echo "<script>
                alert('Invalid login credentials');
                window.location.href='loginpage.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="login.css">
</head>
<body>

<main>
    <h1>Log into your account</h1>

    <section>
        <form method="POST" action="loginpage.php">

            <label>Username</label><br>
            <input type="text" name="name" placeholder="Username"><br>

            <label>Email</label><br>
            <input type="email" name="email" placeholder="email@gmail.com"><br>

            <label>Password</label><br>
            <input type="password" name="password"><br>

            <input type="submit" name="submit" id="button" value="Login">

            <p>
                Don't have an account?
                <a href="../Signup/signup.php">Sign up</a>
            </p>

        </form>
    </section>
</main>

</body>
</html>