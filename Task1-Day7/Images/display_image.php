<?php

$stmt = $pdo->query("SELECT * FROM images");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $imagePath = "../" . $row['file_path']; // adjust based on folder

    echo "<img src='" . $imagePath . "' width='200'><br>";
}
?>