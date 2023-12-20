<?php  
require '../../config/config.php';
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/PostCategory.php");
$date = "";
if(isset($_POST['request_category'])){
	$request_category = $_POST['request_category']);
}
else {
	$suggestion_ta = "";
}
if(isset($_POST['suggestion_ta'])){
	$suggestion_ta = $_POST['suggestion_ta']);
}
else{
	$suggestion_ta = "";
}
$date = date("Y-m-d"); //Current date
$query = mysqli_query($con, "INSERT INTO messages VALUES ('', '$request_category', '$suggestion_ta', '$files', 'no', 'no', '$date')");
?>