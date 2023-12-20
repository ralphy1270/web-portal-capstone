<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Table.php");
include("../classes/Messages.php");

$limit = 6; //Number of posts to be loaded per call

$user_obj = new Messages($con);
$user_obj->messages_outbox_user($_REQUEST, $limit);
?>