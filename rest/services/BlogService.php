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

    public function get_blogs_with_user_for_user($user_id){
        return $this->dao->get_blogs_with_user_for_user($user_id);
    }

    public function get_blog_with_user_by_id($id){
        return $this->dao->get_blog_with_user_by_id($id);
    }

    public function get_number_of_blogs(){
        return $this->dao->get_number_of_blogs();
    }
}
