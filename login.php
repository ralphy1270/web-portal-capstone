<?php
include("includes/header.php"); 
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
</head>
<div class="wrapper" style="height: 100vh;">
	<div class="row-card row">
		<div class="col-md-4"></div>
		<div class="col-md-4 register_index">
			<div class="login_box">

				<div class="login_header">
					Register your Account
				</div>
				<br>
				<form action="login.php" method="POST">
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
					<a href="register.php" id="signup" class="signin">Need and account? Register here!</a>
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