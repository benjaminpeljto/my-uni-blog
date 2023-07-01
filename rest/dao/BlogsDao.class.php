<?php
require_once __DIR__ . "/BaseDao.class.php";

class BlogsDao extends BaseDao
{
    /*
     * Constructor for establishing the connection to the database
     */
    public function __construct()
    {
        parent::__construct("blogs");
    }

    public function get_blogs_with_user()
    {
        $stmt = $this->conn->prepare(
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user', b.user_id
                   FROM blogs b 
                   JOIN users u on b.user_id = u.id;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blog_with_user_by_id($id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user'
                   FROM blogs b 
                   JOIN users u on b.user_id = u.id
                   WHERE b.id=:id"
        );
        $stmt->execute(['id' => $id]); //prevents an SQL injection **binding the parameter
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_writer_by_blog_id($id){
        $stmt = $this->conn->prepare(

        );
    }
}
