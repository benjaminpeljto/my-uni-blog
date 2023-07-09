<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/UsersDao.class.php";

class UserService extends BaseService{

    public function __construct(){
        parent::__construct(new UsersDao);
    }

    function getUserByEmail($email){
        return $this->dao->getUserByEmail($email);
    }

    function add($entity){
        unset($entity['password2']);
        $entity['password'] = md5($entity['password']);
        parent::add($entity);
    }

    function get_number_of_users(){
        return $this->dao->get_number_of_users();
    }

    
}
?>