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

    function get_profile_info($user_id){
        $array = $this->dao->get_by_id($user_id);
        $user = $array[0];
        unset($user['password']);
        unset($user['admin']);
        return $user;
    }

    function update_profile_picture($user_id, $image){
        $user = $this->dao->get_by_id($user_id)[0];
        if(!isset($user['id'])){
            Flight::json(["message" => "User doesn't exist"], 404);
        }
        else{
            $old_picture_delete_hash = $user['profile_picture_delete_hash'];
            Flight::imgurService()->deleteImageAsync($old_picture_delete_hash);
            $upload_data = Flight::imgurService()->uploadImageAsync($image['tmp_name']);
            $result = $this->dao->update_profile_image($user_id, $upload_data[0], $upload_data[1]);
            if($result){
                Flight::json(['success'=>true, 'message'=>'You successfully changed your profile image.', 'image_url'=>$upload_data[0]], 200);
            }
            else{
                Flight::json(['success'=>false, 'message'=>"Error occurred, please try again."], 500);
            }
        }
    }

    
}
