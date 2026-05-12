<?php
require "App/Models/User.php";
require "App/Admin/User.php";

use App\Models\User as UserModel;
use App\Admin\User as AdminModel;

$user=new UserModel();
$admin=new AdminModel();
echo $user->getName();
echo "<br>";
echo $admin->getName();


?>