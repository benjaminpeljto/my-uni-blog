<?php
require_once __DIR__ . "/BaseDao.class.php";

class FeaturedDao extends BaseDao
{
    /*
     * Constructor for establishing the connection to the database
     */
    public function __construct()
    {
        parent::__construct("featured_blogs");
    }


    public function get_featured_blogs_with_user(){
        $stmt = $this->conn->prepare(
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user', b.user_id, u.profile_picture, b.category_id, IF(c.category_name IS NULL, 'Else', c.category_name) as category
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id
                    LEFT JOIN category c ON b.category_id = c.id
                    JOIN featured_blogs fb ON b.id = fb.blog_id
                    ORDER BY b.create_time DESC;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removefromfeatured($blog_id){
        $stmt = $this->conn->prepare(
            "DELETE FROM featured_blogs WHERE blog_id = :blog_id;"
        );
        $stmt->execute(['blog_id'=>$blog_id]);
    }
}