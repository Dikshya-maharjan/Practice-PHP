<?php
abstract class Employee{
    abstract public function work();
}
class Manager extends Employee{
    public function work(){
        echo "I am managing the team";
    }
}
class Developer extends Employee{
    public function work(){
        echo "I am developing software.";
    }
}
$manager=new Manager();
$developer=new Developer();
$manager->work();
echo "<br>";
$developer->work();

?>