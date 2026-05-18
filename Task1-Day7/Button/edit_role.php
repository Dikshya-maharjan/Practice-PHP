<?php
include "../Database/Database.php";

$user_id = $_GET['user_id'];
$role_id = $_GET['role_id'];

$sql = "SELECT * FROM roles";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="POST">
    <select name="role_id">
        <?php foreach ($roles as $role) { ?>
            <option value="<?php echo $role['id']; ?>"
                <?php if($role['id'] == $role_id) echo "selected"; ?>>
                <?php echo $role['role_name']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Update</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $new_role = $_POST['role_id'];

    $sql = "UPDATE role_user 
            SET role_id = :new_role 
            WHERE user_id = :user_id AND role_id = :role_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':new_role' => $new_role,
        ':user_id' => $user_id,
        ':role_id' => $role_id
    ]);

    header("Location: assign_role_users.php");
}
?>