<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Table.php");

$limit = 15; //Number of posts to be loaded per call

$user_obj = new Post($con);
$user_obj->Table_Public_Servants_Script($_REQUEST, $limit);
?>