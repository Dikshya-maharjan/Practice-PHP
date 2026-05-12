<?php
 class Database{
    public function connect(){
        echo "Database Connected!!";
    }
 }
 class User{
    private $db;
    public function __construct(Database $db){
        $this->db=$db;
    }
    public function getUser(){
        $this->db->connect();
    }

 }
 $db=new Database();
 $user=new User($db);
 $user->getUser();

?>