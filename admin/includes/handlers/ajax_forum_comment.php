<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Table.php");
include("../classes/Post.php");

$limit = 3; //Number of posts to be loaded per call

$user_obj = new Post_Body($con);
$user_obj->Forum_Comment($_REQUEST, $limit);
?>