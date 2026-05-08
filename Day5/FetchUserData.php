<?php
// Fetch user data from the database
$pdo=new PDO('mysql:host=localhost;dbname=users','root','');
try{
    //SQl query
    $sql="SELECT * FROM user";
    // Execute the query
    $stmt=$pdo->query($sql);
    // Fetch all user data
    $row=$stmt->fetchALL();
    // Display user data
        echo "User List: <br>";
    foreach($row as $user){
        echo "ID:".$user['id']."<br>";
        echo "Name:".$user['name']."<br>";
        echo "Email:".$user['email']."<br>";
        
    }
    }
    catch(Exception $e){
    echo "Error fetching user data: " . $e->getMessage();
}
?>