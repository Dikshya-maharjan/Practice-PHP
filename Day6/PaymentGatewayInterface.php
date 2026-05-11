<?php
interface PaymentGateway{
    public function pay($amount);
}
class Esewa implements PaymentGateway{
    public function pay($amount){
        echo "Paying $amount through Esewa.";
    }
}
class Khalti implements PaymentGateway{
    public function pay($amount){
        echo "Paying $amount through Khalti.";
    }
}
$esewa=new Esewa();
$khalti=new Khalti();
$esewa->pay(1000);
echo "<br>";
$khalti->pay(2000);


?>