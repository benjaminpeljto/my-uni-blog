<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/FavoritesDao.class.php";

class FavoriteService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new FavoritesDao);
    }

    public function get_favorites_by_user($user_id){
        return $this->dao->getFavoritesByUser($user_id);
    }

}