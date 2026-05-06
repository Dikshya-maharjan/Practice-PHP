<?php
    function applyDiscount(&$x){
      $x=$x- ($x*10/100);
    }
    $a=400;
    applyDiscount($a);
    echo $a;
    
?>
<?php
function addTen(&$num) {
    $num += 10;
}

$value = 5;
addTen($value);
echo "\n $value"; // Expected 15, but not working
?>

<?php
function test($a, $b,) {
    echo $a - $b;
}

test(50, 20,);
?>
