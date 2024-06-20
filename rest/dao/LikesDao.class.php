<?php
require_once __DIR__ . "/BaseDao.class.php";

class LikesDao extends BaseDao
{
    /*
     * Constructor for establishing the connection to the database
     */
    public function __construct()
    {
        parent::__construct("likes");
    }

    public function likeBlog($user_id, $blog_id){
        $stmt = $this->conn->prepare(
            "INSERT INTO likes (user_id, blog_id) VALUES (:user_id, :blog_id);"
        );

        return $stmt->execute(['user_id'=>$user_id, 'blog_id'=>$blog_id]);
    }

    public function unlikeBlog($like_id){
        $stmt = $this->conn->prepare(
            "DELETE FROM likes WHERE id = :like_id;"
        );
        return $stmt->execute(['like_id'=>$like_id]);
    }

    public function findLike($user_id, $blog_id){
        $stmt = $this->conn->prepare(
            "SELECT * FROM likes l WHERE l.user_id = :user_id AND l.blog_id = :blog_id LIMIT 1;"
        );

        $stmt->execute(['user_id'=>$user_id, 'blog_id'=>$blog_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}