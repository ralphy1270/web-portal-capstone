<?php
include("includes/header.php");
//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date 
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname_user'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname_user'] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email_user'] = $em; //Stores email into session variable

	//email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2_user'] = $em2; //Stores email2 into session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Current date

	if($em == $em2) {
		//Check if email is in valid format 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}


	}
	else {
		array_push($error_array, "Emails don't match<br>");
	}


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5) {
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}

	if($password == "password" OR $password2 == "password"){
		array_push($error_array, "Make your password more unique<br>");
	}



	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

        $profile_pic = "";
		//Profile picture assignment
		$rand = rand(0,17); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
		else if($rand == 3)
			$profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
		else if($rand == 4)
			$profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
		else if($rand == 5)
			$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
		else if($rand == 6)
			$profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
		else if($rand == 7)
			$profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
		else if($rand == 8)
			$profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
		else if($rand == 9)
			$profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
		else if($rand == 10)
			$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
		else if($rand == 11)
			$profile_pic = "assets/images/profile_pics/defaults/head_pumpkin.png";
		else if($rand == 12)
			$profile_pic = "assets/images/profile_pics/defaults/head_red.png";
		else if($rand == 13)
			$profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
		else if($rand == 14)
			$profile_pic = "assets/images/profile_pics/defaults/head_turqoise.png";
		else if($rand == 15)
			$profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
		else if($rand == 16)
			$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";


		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', 'user','no','$profile_pic', '', '')");

		header("Location: login.php");
		exit();

		//Clear session variables 
		$_SESSION['reg_fname_user'] = "";
		$_SESSION['reg_lname_user'] = "";
		$_SESSION['reg_email_user'] = "";
		$_SESSION['reg_email2_user'] = "";
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Applicant Account</title>
</head>
<div class="wrapper" style="height: 100vh;">
	<div class="row-card row">
		<div class="col-md-4"></div>
		<div class="col-md-4 register_index">
			<div class="login_box">

				<div class="login_header">
					Create your Account
				</div>
				<br>
				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="First Name" autocomplete="off" value="<?php 
					if(isset($_SESSION['reg_fname_user'])) {
						echo $_SESSION['reg_fname_user'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Last Name" autocomplete="off" value="<?php 
					if(isset($_SESSION['reg_lname_user'])) {
						echo $_SESSION['reg_lname_user'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email" autocomplete="off" value="<?php 
					if(isset($_SESSION['reg_email_user'])) {
						echo $_SESSION['reg_email_user'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" autocomplete="off" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2_user'])) {
						echo $_SESSION['reg_email2_user'];
					} 
					?>" required>
					<br>
					<div id="danger">
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
			        </div>

					<input type="password" name="reg_password" placeholder="Password" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<div id="danger">
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
					else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>";
					else if(in_array("Make your password more unique<br>", $error_array)) echo "Make your password more unique<br>";
					 ?>
			        </div>


					<input type="submit" name="register_button" value="Register">
					<br>

					<a href="login.php" id="signin" class="signin">Already have an account? Sign in here!</a>
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