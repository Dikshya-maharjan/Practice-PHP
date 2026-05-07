
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form method="post">
        <label>Enter your name:</label>
        <input type="text" name="name">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
$username=$_POST['name'];
echo htmlspecialchars("Welcome, " . $username . "!");
?>