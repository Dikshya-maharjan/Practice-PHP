<?php

class Vehicle{
    public $model;
}
class Car extends Vehicle{
    function drive(){
        echo "I am driving.";
    }
}
class Bike extends Vehicle{
    function ride(){
        echo "I am riding.";
    }
}
$cars=new Car();
$bike=new Bike();
$cars->model="Toyota";
$bike->model="Honda";
echo "Car Model: ".$cars->model."<br>";
echo "Bike Model: ".$bike->model."<br>";

?>