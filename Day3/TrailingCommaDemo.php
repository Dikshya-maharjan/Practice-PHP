<!-- Q1: Basic function with trailing comma

👉 Create a function add() that:

takes 2 numbers
returns their sum
use trailing comma in both parameters -->
<?php
function add($a, $b,) {
    return $a + $b;
}
echo add(3, 5,);
?>