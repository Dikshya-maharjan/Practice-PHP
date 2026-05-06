<?php
  function multiply($x,&$y){
    $x=$x*2;
    $y=$y*2;
  }
  $a=3;//value doesnt change in pass by value
  $b=4;//value changes in pass by reference
  multiply($a,$b);
  echo $a . " ".$b;
  //Write a PHP function that:

// Takes a number as reference
// Increases it by 20
// Print the updated value outside the function
  function increment(&$x){
    $x=$x+20;
  }
  $a=5;
  increment($a);
  echo "\n Updated Value is $a";
?>

