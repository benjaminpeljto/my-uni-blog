<?php

require_once __DIR__ . "/rest/dao/UsersDao.class.php";
require_once __DIR__ . "/rest/services/UserService.php";

$dao = new UsersDao();

$type = $_REQUEST["type"];

switch($type){

    case 'add':
        $fname = $_REQUEST["first_name"];
        $lname = $_REQUEST["last_name"];
        $age = $_REQUEST["age"];
        $dao->add("$fname","$lname",$age);
        break;
    case 'update':
        $id = $_REQUEST["id"];
        $fname = $_REQUEST["first_name"];
        $lname = $_REQUEST["last_name"];
        $age = $_REQUEST["age"];
        $dao->update($id,"$fname","$lname",$age);
        break;
    case 'delete':
        $id = $_REQUEST["id"];
        $dao->delete($id);
        break;
    case 'get':
        $service = new UserService();
        $result = $service->get_all();
    default:
        $result = $dao->get_all();
        print_r($result);
}





?>