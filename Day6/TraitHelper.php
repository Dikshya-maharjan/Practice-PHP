<?php
trait Helper{
public function formatText($text){
    return strtoupper($text);
}
}
class Teacher{
    use Helper;
}
class Student{
    use Helper;
}
$teacher=new Teacher();
$student=new Student();
echo "Teacher: ".$teacher->formatText("Hello, I am a teacher.")."<br>";
echo "Student: ".$student->formatText("Hello, I am a student.");
?>