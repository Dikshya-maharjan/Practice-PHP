<?php
foreach(range(1,5) as $value){
  //range(1,5) creates array automatically 
  echo "$value\n";
  
  
}
echo "\n";
  $array=[
    [1,2],
    [3,4],
    ];
    foreach($array as [$a,$b]){
      echo "A: $a; $b\n";
    }
  ?>