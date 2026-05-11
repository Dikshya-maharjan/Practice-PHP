<?php
trait Loggable{
    public function log(){
        echo "Log: ";
    }   
}
trait Shareable{
    public function share(){
        echo "Share: ";
    }
}
class Article{
    use Loggable,Shareable;
    public function Letter(){
        echo "This is an article.";
    }

}
$article=new Article();
$article->log();
echo "<br>";
$article->share();
echo "<br>";
$article->Letter();
echo "<br>";


?>