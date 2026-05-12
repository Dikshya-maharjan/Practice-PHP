<?php
class FileHandler{
    public function __destruct(){
        echo "Destroying";
    }
}
$obj=new FileHandler();

?>