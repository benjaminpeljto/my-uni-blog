<?php

Flight::route("POST /like/@blog_id/@user_id", function ($blog_id, $user_id){
    Flight::likeService()->toggleLikeBlog($user_id, $blog_id);
});