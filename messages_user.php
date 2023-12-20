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
	<style type="text/css">
		#messages_user {
			  width: 100%;
			  margin: 86px auto 0 auto;
			  border: none;
			  height: 572px;
		}

	</style>
</head>
<body class="body_message">
	
	<iframe src="admin/messages_user.php?u=new" id="messages_user" scrolling="auto"></iframe>

<?php include("footer.php");  ?>	
</body>
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
