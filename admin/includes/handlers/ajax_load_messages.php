<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Messages.php");

$limit = 7; //Number of messages to load

$message = new Messages($con, $_REQUEST['userLoggedIn']);
echo $message->getConvosDropdown($_REQUEST, $limit);

?>