<?php
  class EvenFunc{
    public function numbers($num){
      return array_filter($num,fn($value)=>$value%2==0);
    }
   
  }
   $num=[1,2,3,4,5,6,7,8,9];
    $evennum=new EvenFunc();
    $result=$evennum->numbers($num);
    print_r($result);
?>