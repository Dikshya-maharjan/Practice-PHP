<?php
require "App/Models/Product.php";
use App\Models\Product;
$product=new Product();
echo $product->getProduct();
?>