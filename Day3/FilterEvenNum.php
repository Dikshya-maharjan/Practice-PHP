<!-- 🔹 Q1: Filter even numbers
Given an array:

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
Task:
Use array_filter()
Return only even numbers -->
<?php
  $numbers=[1,2,3,4,5,6,7,8,9,10];
  $result=array_filter($numbers,function($n){
    return $n%2==0;
  });
  print_r($result);
?>