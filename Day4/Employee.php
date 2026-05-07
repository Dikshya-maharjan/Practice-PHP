<?php
   class Employee{
     public function __construct($name,$salary){
       $this->name=$name;
       $this->salary=$salary;
     }
   }
   $emp1=new Employee("Ram",12500);
   $emp2=new Employee("Hari",15500);
   $emp3=new Employee("Ram",20000);
   $emp4=new Employee("Hari",31000);
   $emp5=new Employee("Hari",34000);
   
   $employees=[$emp1,$emp2,$emp3,$emp4,$emp5];
   $maxSalary=$employees[0]->salary;
   $highestEmployee=$employees[0];
   
  foreach($employees as $emp){
    echo $emp->name . "\n";
    echo $emp->salary . "\n";
    if($emp->salary > $maxSalary){
        $maxSalary = $emp->salary;
        $highestEmployee = $emp;
    }
}
echo "Highest Salary: " . $highestEmployee->salary . "\n";
echo "Employee Name: " . $highestEmployee->name;
   
   

?>