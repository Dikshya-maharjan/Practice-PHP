<?php
class PaymentGateway{
        public function placeOrder(){
            echo "Order has been placed";
        }
}
class Order{
    private $PaymentGateway;

    public function __construct(PaymentGateway $PaymentGateway){
        $this->PaymentGateway = $PaymentGateway;
    }
    public function sucess(){
        echo "Payment Successful";
    }
}
$PaymentGateway=new PaymentGateway();
$order=new Order($PaymentGateway);
$order->sucess();


?>