<?php
  class DoubleNum{
    public function doubleNumbers($numbers){
      return array_map(function($number){
        return $number*2;
      },$numbers);
    }
  }
  $numbers=[1,2,3,4];
  $filter=new DoubleNum();
  $result=$filter->doubleNumbers($numbers);
  print_r($result);
?>