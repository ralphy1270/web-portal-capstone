<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");

$limit = 3; //Number of posts to be loaded per call

$user_obj = new Post($con);
$user_obj->Updates_Services($_REQUEST, $limit);
?>