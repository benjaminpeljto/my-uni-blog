<?php

class UsersDao{

    private $conn;


    public function __construct(){
        $servername = "localhost";
        $db = "blog_db";
        $user = "benjamin";
        $pass = "71000Sarajevo";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_user($fname,$lname,$age){
        $stmt = $this->conn->prepare("INSERT INTO users (first_ame,last_ame,age) VALUES('$fname','$lname','$age');");
        $stmt->execute();
    }

    public function add_user_url(){
        $fname = $_REQUEST["first_name"];
        $lname = $_REQUEST["last_name"];
        $age = $_REQUEST["age"];
        $stmt = $this->conn->prepare("INSERT INTO users (first_name,last_name,age) VALUES('$fname','$lname','$age');");
        $stmt->execute();
    }






}




?>