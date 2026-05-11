<?php
class Shape{
    public function draw(){}
}
class Circle extends Shape{
    public function draw(){
        echo "Drawing a circle.";
    }
}

class Rectangle extends Shape{
    public function draw(){
        echo "Drawing a rectangle.";
    }
}
function drawShape(Shape $shape){
    $shape->draw();
}
drawShape(new Circle());
drawShape(new Rectangle());
?>