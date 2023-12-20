<?php  

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable 
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password' AND archieved='no'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];
		$usertype = $row['user_type'];
		if($usertype == "super admin" || $usertype == "admin"){
			$_SESSION['username'] = $username;
			header("Location: index.php");
			exit();
		}
		if($usertype == "unapprove") {
			array_push($error_array, "Account not yet confirmed by Super Admin<br>");
		}
		if($usertype == "user") {
			array_push($error_array, "Only Admin can access this page<br>");
		}
		
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}


}

?>