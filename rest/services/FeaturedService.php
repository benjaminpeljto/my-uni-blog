<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/FeaturedDao.class.php";

class FeaturedService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new FeaturedDao);
    }

    public function get_featured_blogs_with_user(){
        return $this->dao->get_featured_blogs_with_user();
    }

    public function removefromfeatured($blog_id){
        $this->dao->removefromfeatured($blog_id);
    }

}