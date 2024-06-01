<?php
require_once __DIR__ . "/BaseDao.class.php";

class UsersDao extends BaseDao{
    /*
    * Constructor for establishing the connection to the database
    */
    public function __construct(){
        parent::__construct("users");
    }

    /*
     *  Method for getting first user with forwarded email
     */
    public function getUserByEmail($email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email'=>$email]);
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($array);
    }

    public function get_number_of_users(){
        $stmt = $this->conn->prepare(
            "SELECT COUNT(u.id) as numberOfUsers FROM users u;"
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['numberOfUsers'];

    }

    public function update_profile_image($user_id, $image_url, $image_delete_hash) {
        $stmt = $this->conn->prepare(
            "UPDATE users SET profile_picture = :profile_picture_url, profile_picture_delete_hash = :profile_picture_delete_hash WHERE id = :user_id;"
        );
        return $stmt->execute(['user_id' => $user_id, 'profile_picture_url' => $image_url, 'profile_picture_delete_hash' => $image_delete_hash]);
    }




    /*
    * Method for fetching all users from the database
    */
   /*  public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */

    /*
    * Method for fetching a specific user from the database
    */

    /* public function get_by_id($id){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */


    /*
    * Method for adding a new user to the database
    */
    /* public function add_user($user){
        $stmt = $this->conn->prepare("INSERT INTO users (first_name,last_name,age) VALUES (:first_name,:last_name,:age);");
        $stmt->execute($user);
        $user['id'] = $this->conn->lastInsertId();
        return $user;
    } */


    /*
    * Method for updating an existing user in the database
    */
    /* public function update_user($user,$id){
        $user['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE users SET first_name=:first_name, last_name = :last_name, age = :age WHERE user_id = :id");
        $stmt->execute($user);
        return $user;
    } */
    //$stmt->execute(['id'=>$id,'first_name'=>$first_name,'last_name'=>$last_name,'age'=>$age]);


    /*
    * Method for deleting an user from the database
    */
    /* public function delete_user($id){
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = :id");
        $stmt->bindParam(":id",$id); //prevents an SQL injection
        $stmt->execute();
    } */
    






}




?>