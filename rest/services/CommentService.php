<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/CommentsDao.class.php";

class CommentService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new CommentsDao);
    }

}
