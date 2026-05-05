<?php
$name=["Ram","Hari","Sita","Gita","Rita"];
foreach($name as $names){
  if($names == 'Sita'){
    break;
  }
  
  echo "$names \n";
}
$i=0;
while(++$i<4){
  echo "Hello first \n";
  while(1){
    echo "Number 1 \n";
    while(1){
      echo "Number 2 \n";
      continue 3;
    }
  }
  
}
?>