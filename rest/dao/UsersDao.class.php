<?php

class UsersDao{

    private $conn;
    /*
    * Constructor for establishing the connection to the database
    */
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



    /*
    * Method for fetching all users from the database
    */
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /*
    * Method for adding a new user to the database
    */
    public function add_user($fname,$lname,$age){
        $stmt = $this->conn->prepare("INSERT INTO users (first_name,last_name,age) VALUES('$fname','$lname','$age');");
        $stmt->execute();
    }


    /*
    * Method for adding a new user to the database, provided first_name and last_name from the url
    * using the GET global variable
    */
    public function add_user_url(){
        $fname = $_REQUEST["first_name"];
        $lname = $_REQUEST["last_name"];
        $age = $_REQUEST["age"];
        $stmt = $this->conn->prepare("INSERT INTO users (first_name,last_name,age) VALUES('$fname','$lname','$age');");
        $stmt->execute();
    }

    






}




?>