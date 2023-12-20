<?php
include("../../config/config.php");
include("../../includes/classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

/*$names = explode(" ", $query);*/
$str=array();
$searchTerms = explode(" ", $query);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $query_user = mysqli_query($con, "SELECT * FROM forum WHERE question LIKE '%$term%'");
    while($row_user = mysqli_fetch_array($query_user)){
    	$id = $row_user['id'];
    	$question = $row_user['question'];
    	$ask_by = $row_user['ask_by'];

    	$dots = (strlen($question) >= 90) ? "..." : "";
		$question = str_split($question, 90);
		$question = $question[0] . $dots;

    	$query_pic = mysqli_query($con, "SELECT * FROM users WHERE username = '$ask_by'");
    	$row_pic = mysqli_fetch_array($query_pic);
    	$profile_pic = $row_pic['profile_pic'];
    	$new = "<div class='tab_search_forum'>
    				<a href='search.php?q=$query&s=$id'>
	    				<img src='../$profile_pic'>
	    				<div class='tab_search_forum_question' style='margin-left: 14px;margin-left: 14px;color:grey;'>
	    					$question
	    				</div>
	    			</a>
    			</div>";
    	if(!in_array($new, $str)) {

				array_push($str, $new);
			}
    	
    }

}

foreach($str as $value){
     echo $value;
}


	



?>