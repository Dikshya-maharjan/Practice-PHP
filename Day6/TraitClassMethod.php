<?php
trait A{
    public function message(){
        echo "Hello World";
    }
}
class Test{
    public function message(){
        echo "Hello World from Test class";
    }
}
$test=new Test();
$test->message();

?>