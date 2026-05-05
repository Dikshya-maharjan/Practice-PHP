<?php
    $names=array('Ram','Gita','Sita');
    var_dump("Original array name: ",$names);
    array_push($names,"Hari");
    echo "</br>";
    var_dump("Add one more item at end of the array : ",$names);
    echo "</br>";
    array_unshift($names,"Shyam");
    var_dump("Add one more item at the beginning of the array : ",$names);
    echo "</br>";
     array_shift($names);
    var_dump("Remove first item of the array : ",$names);
    echo "</br>";
    array_splice($names,0,1);
    var_dump("Remove first item from the array : ",$names);
    echo "</br>";
    array_pop($names);
    var_dump("Remove last item from the array : ",$names);
    echo "</br>";
    array_reverse($names);
    var_dump("Reverse the array : ",$names);
    echo "</br>";
    array_push($names,"Hari","Shyam");
    sort($names);
    var_dump("Add two more items at end of the array  and sorting : ",$names);
    echo "</br>";

?>