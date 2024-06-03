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

    function updateProfileData($user_data, $user_id){
        $user = $this->dao->get_by_id($user_id)[0];
        if(isset($user['id'])){
            if($user['password'] == md5($user_data['password'])){
                unset($user_data['password']);
                $returned_entity = $this->dao->update($user_data, $user_id);
                if(isset($returned_entity['id'])){
                    Flight::json(['success'=>true, 'message'=>"Profile data updated successfully."]);
                } else {
                    Flight::json(['success'=>false, "message"=>"Error updating profile data. Please contact developers."]);
                }
            } else {
                Flight::json(['success'=>false, 'message'=>"Incorrect password"]);
            }
        } else {
            Flight::json(['success'=>false, 'message'=>"User doesn't exist."]);
        }
    }

    function changePassword($password_data, $user_id)
    {
        if ($password_data['password'] !== $password_data['password2']) {
            Flight::json(['success' => false, 'message' => "Passwords don't match."]);
        }

        $user = $this->dao->get_by_id($user_id)[0];
        if (isset($user['id'])) {
            if ($user['password'] === md5($password_data['profileCurrentPassword'])) {
                if($user['password'] === md5($password_data['password'])){
                    Flight::json(['success'=>false, "message"=>"You cannot enter the same password."]);
                } else {
                    unset($password_data['password2']);
                    unset($password_data['profileCurrentPassword']);
                    $password_data['password'] = md5($password_data['password']);
                    $returned_entity = $this->dao->update($password_data, $user_id);
                    if(isset($returned_entity['id'])){
                        Flight::json(['success'=>true, 'message'=>"Changed profile password."]);
                    } else {
                        Flight::json(['success'=>false, "message"=>"Error while changing password. Please contact developers."]);
                    }
                }
            } else {
                Flight::json(['success' => false, 'message' => "Incorrect password."]);
            }
        } else {
            Flight::json(['success' => false, 'message' => "User doesn't exist."]);
        }
    }

    function get_users_for_admin(){
        Flight::json($this->dao->get_users_for_admin());
    }

    function ban_user($user_id){
        $user = $this->dao->get_by_id($user_id)[0];
        if(isset($user['id'])){
            if($user['admin'] == 1){
                Flight::json(['success'=>false, "message"=>"Something went wrong."]);
            } else {
                $rows_affected = $this->dao->ban_user($user_id);
                if($rows_affected !== 1){
                    Flight::json(['success'=>false, "message"=>"Something went wrong."]);
                } else {
                    Flight::json(['success'=>true, "message"=>"User with ID " . $user_id . " successfully banned."]);
                }
            }
        } else{
            Flight::json(['success'=>false, "message"=>"User doesn't exist."]);
        }
    }

    function unban_user($user_id){
        $user = $this->dao->get_by_id($user_id)[0];
        if(isset($user['id'])){
            $rows_affected = $this->dao->unban_user($user_id);
            if($rows_affected !== 1){
                Flight::json(['success'=>false, "message"=>"Something went wrong."]);
            } else {
                Flight::json(['success'=>true, "message"=>"User with ID " . $user_id . " successfully unbanned."]);
            }
        } else{
            Flight::json(['success'=>false, "message"=>"User doesn't exist."]);
        }
    }
}
