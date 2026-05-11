<?php
class Logger{
    public function log($message){
        echo "Log: ".$message;
    }
}
$obj=new Logger();
$obj->log("Loading message ....");
echo "<br>";

?>