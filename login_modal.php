<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/PostCategory.php");

$user_obj = new Post($con);
$get_obj = new User($con);
$get_category = new PostCategory_Content($con);

$error_array_user = array(); //Holds error messages
$error_array = array(); //Holds error messages
if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email_user'] = $email; //Store email into session variable 
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password' AND archieved='no' AND user_type='user'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];
		$_SESSION['username_applicant'] = $username;
		header("Location: index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Applicant Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/images/icons/logo.ico">
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style-link.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
	<link rel="stylesheet" href="css/arrow.css">
	<link rel="stylesheet" href="css/fixed.css">
	<link rel="stylesheet" href="css/waypoints.css">

    <script src="assets/js/jquery.Jcrop.js"></script>
    <script src="assets/js/jcrop_bits.js"></script>
    <script src="assets/js/demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<div class="wrapper" style="height: 100vh;margin: -80px 0 0 -13px;">
	<div class="row-card row">
		<div class="col-md-4"></div>
		<div class="col-md-4 register_index">
			<div class="login_box">

				<div class="login_header">
					Register your Account
				</div>
				<br>
				<form action="login.php" method="POST" target="_top">
					<input type="email" name="log_email" placeholder="Email Address" autocomplete="off" value="<?php 
					if(isset($_SESSION['log_email_user'])) {
						echo $_SESSION['log_email_user'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password" required>
					<br>
					<div id="danger">
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
					<?php if(in_array("Account not yet confirmed by Super Admin<br>", $error_array)) echo  "Account not yet confirmed by Super Admin<br>"; ?>
					<?php if(in_array("Only Admin can access this page<br>", $error_array)) echo  "Only Admin can access this page<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>
				    </div>
					<a href="register.php" id="signup" class="signin" target="_top">Need and account? Register here!</a>
				</form>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>	
<!--- Script Source Files -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="js/all.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/waypoints.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.counterup.js"></script>
<script src="js/validator.js"></script>
<script src="js/contact.js"></script>
<script src="assets/js/demo.js"></script>
<!--- End of Script Source Files -->