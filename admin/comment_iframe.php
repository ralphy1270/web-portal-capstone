<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

$user_obj = new Post_Body($con);

if (isset($_GET['u'])) {
 	$id=$_GET['u'];

}
else{
	$id = "none";
}

if(isset($_SESSION['username_applicant'])) {
  $userLoggedIn = $_SESSION['username_applicant'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
  $admin_type = $user['user_type'];
}
else if(isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
  $admin_type = $user['user_type'];
}
else {
  header("Location: register.php");
}

if (isset($_POST['send'])) {
	if($_POST['comment'] != ""){
		$comment = $_POST['comment'];
		$date = date("Y-m-d"); //Current date
		$query = mysqli_query($con, "INSERT INTO comment VALUES('', '$comment', '$userLoggedIn', 'no', 'no','$date','$id')");
	}
	else{
		
	}

}
else {
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!--<script src="js/jquery-3.3.1.min.js"></script>-->
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 
	<!--<link rel="stylesheet" type="text/css" href="js/font-awesome.min.css"></script>-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">	
	<style type="text/css">
		body {
			background-color: #ffff;
		}
	</style>
</head>
<body>
	<div id="forum_comment">			
		<!-- forum -->	
		<form action="comment_iframe.php?u=<?php echo $id; ?>" method="POST">
			<div id="" style="display: <?php if($no_error == "no"){echo "none;";}if($no_error == "yes") {echo "block;";} ?>">
				<div class=" input-group mb-3" style="">
				  <textarea class="form-control" placeholder="Add Reply..." style="width: 100%;" name="comment"></textarea>
				  <div class="input-group-append" style="">
				    <button class="btn btn-primary" type="submit" name="send" style="margin: 5px 0 0 683px;">Send</button>
				  </div>
				</div>
			</div>
		</form>		
		
					
				<div class="applicants_comments posts_area">
						
					<?php echo $user_obj->Forum_Comment($id); ?>		
					
				</div>

	<!-- forum -- >		
	</div>		


</body>
</html>



