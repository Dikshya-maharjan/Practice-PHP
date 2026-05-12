<!-- Question 4 — Student and Book

Create:

Book class
Student class

Inject Book into Student.

Display:

Student is reading boo -->
<?php
class Book{
    public function read(){
        echo "Student opened";
    }

}
class Student{
    private $book;
    public function __construct(Book $book){
        $this->book=$book;
    }
    public function reading(){
        $this->book->read();
        echo "<br> Student is reading book";
    }
}
$book=new Book();
$student=new Student($book);
$student->reading();

?>