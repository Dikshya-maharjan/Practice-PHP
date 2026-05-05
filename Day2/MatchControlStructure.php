<?php
$day=3;
 $return_value=match($day){
   1=>"First day is Sunday",
   2=>"Second  day is Monday",
   3=>"third  day is Tuesday",
   4=>"fourth day is Wednesday",
   5=>"fifth day is Thursday",
   6=>"sixth day is Friday",
   7=>"Seventh day is Saturday",
   default=>"Unknown Day",
 };
  var_dump($return_value);
?>

<?php
$grade='C';
 $return_value=match($grade){
   'A'=>"Excellent",
   'B'=>"Good",
   default=>"Average",
 };
 echo " grade is $return_value";
 ?>
 
 <?php
 $role="viewer";
 $return_value=match($role){
   'admin'=>"Full Access",
   'editor'=>"Edit Access",
   'viewer'=>"Read only",
   'default'=>"No Access",
 };
 echo "\n$return_value";
 ?>
 
 <?php
 $age=18;
 $return_value=match(true){
   $age<2=>"Baby",
   $age<13=>"Child",
   $age<=18=>"Teenager",
  
   default=>"Adult",
 };
 echo "\n $return_value";
 ?>
 
 <?php
 $name='Dikshya';
 $password='123456';
 $return_value=match(true){
   empty($name)=>"Empty Name",//if $name has an empty string then it would give this output
   strlen($password)<6 =>"Weak Password",//as $name has true condition it moves to password which has false condition
   default=>"Valid",
 };
 echo $return_value;
 ?>
 
 <?php
 $text="Hello World";
 $result=match(true){
   str_contains($text,"Hello")||str_contains($text,"BYE")=>"Contained Hello ",
   str_contains($text,"Hi") || str_contains($text,"World")=>"ContainS  World",
   default=>"Doesnt contain",
 };
 echo $result;
 ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 