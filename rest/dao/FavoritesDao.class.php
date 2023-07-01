<?php
require_once __DIR__ . "/BaseDao.class.php";

class FavoritesDao extends BaseDao
{
    /*
     * Constructor for establishing the connection to the database
     */
    public function __construct()
    {
        parent::__construct("favorite_blogs");
    }


    public function getFavoritesByUser($user_id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) as 'user', b.user_id
                FROM favorite_blogs fb
                JOIN blogs b ON fb.blog_id = b.id
                JOIN users u ON b.user_id = u.id
                WHERE fb.user_id = :user_id;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}