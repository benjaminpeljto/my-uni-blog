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
            "SELECT b.id, b.title, b.content, b.create_time, CONCAT(u.first_name, ' ', u.last_name) AS 'user', u.profile_picture, b.user_id, b.category_id, IF(c.category_name IS NULL, 'Else', c.category_name) AS category
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY b.create_time DESC;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blogs_newest_with_user_for_user($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY b.create_time DESC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blogs_oldest_with_user_for_user($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY b.create_time ASC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blogs_most_liked_with_user_for_user($user_id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY likes_num DESC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blogs_least_liked_with_user_for_user($user_id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY likes_num ASC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_blogs_featured_with_user_for_user($user_id){
        $stmt = $this->conn->prepare(
            "SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id
                    JOIN featured_blogs fb ON b.id = fb.blog_id
                    LEFT JOIN category c ON b.category_id = c.id
                    ORDER BY likes_num ASC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
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

    public function get_number_of_blogs() {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(b.id) as numberOfBlogs FROM blogs b;"
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['numberOfBlogs'];
    }

    public function get_my_blogs($user_id){
        $stmt = $this->conn->prepare("
                           SELECT b.id, 
                           b.title, 
                           b.content, 
                           b.create_time, 
                           CONCAT(u.first_name, ' ', u.last_name) AS 'user', 
                           u.profile_picture, 
                           b.user_id, 
                           b.category_id, 
                           IFNULL(c.category_name, 'Else') AS category, 
                           EXISTS (
                               SELECT 1 
                               FROM likes l 
                               WHERE l.blog_id = b.id 
                                 AND l.user_id = :user_id
                           ) AS liked_by_user, 
                           (SELECT COUNT(*) 
                            FROM likes l 
                            WHERE l.blog_id = b.id) AS likes_num
                    FROM blogs b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN category c ON b.category_id = c.id
                    WHERE b.user_id = :user_id
                    ORDER BY b.create_time DESC;"
        );
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
