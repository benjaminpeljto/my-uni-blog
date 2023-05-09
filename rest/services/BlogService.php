<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/BlogsDao.class.php";

class BlogService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new BlogsDao);
    }

}
