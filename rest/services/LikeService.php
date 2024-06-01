<?php
require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/LikesDao.class.php";
class LikeService extends BaseService
{
    public function __construct(){
        parent::__construct(new LikesDao);
    }

    function toggleLikeBlog($user_id, $blog_id){
        $queryedLike = $this->dao->findLike($user_id, $blog_id);
        if(isset($queryedLike['id'])){
            $result = $this->dao->unlikeBlog($queryedLike['id']);
            if($result){
                Flight::json(['message'=>"Unliked blog.", 'success'=>true]);
            } else{
                Flight::json(['message'=>"Error occurred.", 'success'=>false]);
            }
        }
        else {
            $result = $this->dao->likeBlog($user_id, $blog_id);
            if($result){
                Flight::json(['message'=>"Liked blog.", 'success'=>true]);
            } else {
                Flight::json(['message'=>"Error occurred.", 'success'=>false]);
            }
        }
    }
}