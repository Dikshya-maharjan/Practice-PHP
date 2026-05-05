<?php
class Example {
    private bool $modified = false;//state management which is used to detect if value was changed after initialization or not
    private string $foo = 'default';//actual data being stored where it cant be accesed directly from outside
    //encapsulation

    public function setFoo(string $value) {//setter method
        $this->foo = strtoupper($value);//ensures data consistency where "HELLO","Helo","hello" all become hello
        $this->modified = true;//before modified was false now it changes to true
    }

    public function getFoo() {//getter method
        if ($this->modified) {
            return $this->foo . ' (modified)';
        }
        return $this->foo;
    }
}

$example = new Example();
$example->setFoo('changed');

echo $example->getFoo();
?>

<?php
class User{
  private bool $modified=false;
  private string $name='Ram';
  public function setName(string $value){
    $this->name=strtolower($value);
    $this->modified=true;
  }
  public function getName(){
    if($this->modified){
      return $this->name . ' user name changed';
    }
  }
}
$user=new User();
$user->setName('Dikshya');
echo $user->getName();
?>