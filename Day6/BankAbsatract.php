<?php
abstract class Bank{
    abstract public function interestRate();
    function bankInfo(){
        echo "This is a bank.";
    }
}
class Everest extends Bank{
    public function interestRate(){
        return "Everest Bank Interest Rate: 5%";
    }
    public function bankInfo(){
        echo "This is Everest Bank.";
    }
}
class Nabil extends Bank{
    public function interestRate(){
        return "Nabil Bank Interest Rate: 4.5%";
    }
    public function bankInfo(){
        echo "This is Nabil Bank.";
    }
}
$everest=new Everest();
$nabil=new Nabil();
$everest->bankInfo();
echo "<br>";
echo $everest->interestRate();
echo "<br>";
$nabil->bankInfo();
echo "<br>";
echo $nabil->interestRate();
?>