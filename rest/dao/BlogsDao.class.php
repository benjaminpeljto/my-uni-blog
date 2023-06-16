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
            "SELECT b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user'
                   FROM blogs b 
                   JOIN users u on b.user_id = u.id;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
