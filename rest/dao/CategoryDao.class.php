<?php
require_once __DIR__ . "/BaseDao.class.php";

class CategoryDao extends BaseDao
{
    /*
     * Constructor for establishing the connection to the database
     */
    public function __construct()
    {
        parent::__construct("category");
    }

    public function get_blogs_by_category($id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user', b.user_id, b.category_id, IF(c.category_name IS NULL, 'N/A', c.category_name) as category
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id
                    LEFT JOIN category c ON b.category_id = c.id
                    WHERE b.category_id = :id;"
        );
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}