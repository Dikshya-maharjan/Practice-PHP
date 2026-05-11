<?php
  class Person{
    public $name;
    public $age;
    
  }
  class Student extends Person{
    function study(){
        echo "I am studying.";
    }
  }
  $std=new Student();
    $std->name="John";
    $std->age=20;
    echo "Name: ".$std->name."<br>";
    echo "Age: ".$std->age."<br>";
    $std->study();
?>