<?php
class Student{
    public $name;
    public $age;
    public function __construct($name,$age){
        $this->name=$name;
        $this->age=$age;
    }
    
    }
    $info=new Student(" Dikshya",21);
    echo $info->name;
    echo "<br>";
    echo $info->age;

?>