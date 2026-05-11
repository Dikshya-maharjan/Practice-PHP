<?php
interface Logger{
    public function log($message);
}
abstract class User implements Logger{
    abstract public function getRole();
}
class Admin extends User{
    public function getRole(){
        echo "I am an Admin.";
    }
     public function log($message){
        echo "Admin Log: $message";
}
}
$admin=new Admin();
$admin->getRole();
echo "<br>";
$admin->log("This is a log message.");
?>