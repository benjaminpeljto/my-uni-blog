<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/CategoryDao.class.php";

class CategoryService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new CategoryDao());
    }

    public function get_blogs_by_category($id){
        return $this->dao->get_blogs_by_category($id);
    }

}