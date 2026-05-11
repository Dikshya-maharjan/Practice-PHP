<?php
interface Payment{
    public function pay($amount);
}
class Esewa implements Payment{
    public function pay($amount){
        echo "Paying $amount through Esewa.";
    }

}
class Khalti implements Payment{
    public function pay($amount){
        echo "Paying $amount through Khalti.";
    }
}
class Card implements Payment{
    public function pay($amount){
        echo "Paying $amount through Card.";
    }
}
function PaymentSystem(Payment $payment, $amount){
    $payment->pay($amount);
}
PaymentSystem(new Esewa(), 1000);
echo "<br>";
PaymentSystem(new Khalti(), 2000);
echo "<br>";
PaymentSystem(new Card(), 3000);

?>