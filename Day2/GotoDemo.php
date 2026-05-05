<?php
  goto a;
  echo "Foo";
  a:
  echo 'Bar';
  
  for($i=0;$i<100;$i++){//outer loop
    for($j=50;$j<100;$j++){//inner loop
      while($j--){//$j keeps decreasing until 0
        if($j==25){//if $j reaches 25 then it will jumps to the label end
          goto end;
        }
      }
    }
  }
  echo "\n i=$i";
  end:
  echo "\n j hit 25";//it will directly print this
?>
<?php
class SimpleClass
{
    // property declaration
    public $var = 'a default value';

    // method declaration
    public function displayVar() {
        echo $this->var;
    }
}
?>