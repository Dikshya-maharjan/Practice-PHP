<?php
$cars=array(
  array("BMW",15,13),
  array("Tesla",12,8),
  array("Land Rover",17,15)
  );
  
echo $cars[0][0].":In stock : ".$cars[0][1].", sold: ".$cars[0][2].".\n"; //$cars[row][column],[0][0]->bmw,[0][1]->15[0,2]=>13
echo $cars[1][0].":In stock : ".$cars[1][1].",sold:".$cars[1][2].".\n";
echo $cars[2][0].":In stoc  :".$cars[2][1].",sold:".$cars[2][2].".\n";

for($row=0;$row<3;$row++){
  echo " Number $row \n";
  for($col=0;$col<3;$col++){
    echo $cars[$row][$col]."\n";
  }
}

?>