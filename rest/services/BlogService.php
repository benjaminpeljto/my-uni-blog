<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/BlogsDao.class.php";

class BlogService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new BlogsDao);
    }

    public function get_blogs_with_user(){
        return $this->dao->get_blogs_with_user();
    }

    public function get_blogs_all_random_with_user_for_user($user_id){
        $blogs_newest = $this->dao->get_blogs_newest_with_user_for_user($user_id);
        shuffle($blogs_newest);
        return $blogs_newest;
    }

    public function get_blogs_newest_with_user_for_user($user_id){
        return $this->dao->get_blogs_newest_with_user_for_user($user_id);
    }

    public function get_blogs_oldest_with_user_for_user($user_id){
        return $this->dao->get_blogs_oldest_with_user_for_user($user_id);
    }

    public function get_blogs_most_liked_with_user_for_user($user_id){
        return $this->dao->get_blogs_most_liked_with_user_for_user($user_id);
    }

    public function get_blogs_least_liked_with_user_for_user($user_id){
        return $this->dao->get_blogs_least_liked_with_user_for_user($user_id);
    }

    public function get_blog_with_user_by_id($id){
        return $this->dao->get_blog_with_user_by_id($id);
    }

    public function get_number_of_blogs(){
        return $this->dao->get_number_of_blogs();
    }

    public function get_my_blogs($user_id){
        return $this->dao->get_my_blogs($user_id);
    }
}
