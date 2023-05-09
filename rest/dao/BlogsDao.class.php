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
}
