<?php
    class Product{
      public $pname;
      public $pid;
      public $price;
      
      public function __construct($pid,$pname,$price){
         $this->pid=$pid;
         $this->pname=$pname;
         $this->price=$price;

      }
      
    }
    $product1=new Product(1,"Chips",50);
    $product2=new Product(2,"Noodles",20);
    $product3=new Product(3,"Chocolate",100);
    
    $info=[$product1,$product2,$product3];
    
    $total=0;
    
    foreach($info as $values){
      echo $values->pid . "\n" . $values->pname . "\n" . $values->price ."\n";
      $total +=$values->price;
      
    }
    echo "Total is :". $total;
    
?>