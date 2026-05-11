<?php
require "Models/User.php";
use App\Models\User;
$user=new User();
echo $user->getName();
?>