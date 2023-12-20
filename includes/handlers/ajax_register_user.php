<?php  
require '../../config/config.php';
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/PostCategory.php");

//Declaring variables to prevent errors
$firstname_user = ""; //First name
$lastname_user = ""; //Last name
$email_user = ""; //email
$em2 = ""; //email 2
$password_user = ""; //password
$password_user = ""; //password 2
$date_user = ""; //Sign up date 
$error_array_user = array(); //Holds error messages

if(isset($_POST['register_index'])){

	//Registration form values

	//First name
	$firstname_user = strip_tags($_POST['firstname_user']); //Remove html tags
	$firstname_user = str_replace(' ', '', $firstname_user); //remove spaces
	$firstname_user = ucfirst(strtolower($firstname_user)); //Uppercase first letter
	$_SESSION['reg_firstname_user'] = $firstname_user; //Stores first name into session variable

	//Last name
	$lastname_user = strip_tags($_POST['lastname_user']); //Remove html tags
	$lastname_user = str_replace(' ', '', $lastname_user); //remove spaces
	$lastname_user = ucfirst(strtolower($lastname_user)); //Uppercase first letter
	$_SESSION['reg_lastname_user'] = $lastname_user; //Stores last name into session variable

	//email
	$email_user = strip_tags($_POST['email_user']); //Remove html tags
	$email_user = str_replace(' ', '', $email_user); //remove spaces
	$email_user = ucfirst(strtolower($email_user)); //Uppercase first letter
	$_SESSION['reg_email_user'] = $email_user; //Stores email into session variable

	//email 2
	$email_user2 = strip_tags($_POST['email_user2']); //Remove html tags
	$email_user2 = str_replace(' ', '', $email_user2); //remove spaces
	$email_user2 = ucfirst(strtolower($email_user2)); //Uppercase first letter
	$_SESSION['reg_email_user2'] = $email_user2; //Stores email2 into session variable

	//Password
	$password_user = strip_tags($_POST['password_user']); //Remove html tags
	$password_user2 = strip_tags($_POST['password_user2']); //Remove html tags

	$date_user = date("Y-m-d"); //Current date

	if($email_user == $email_user) {
		//Check if email is in valid format 
		if(filter_var($email_user, FILTER_VALIDATE_EMAIL)) {

			$email_user = filter_var($email_user, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email_user'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array_user, "Email already in use<br>");
			}

		}
		else {
			array_push($error_array_user, "Invalid email format<br>");
		}


	}
	else {
		array_push($error_array_user, "Emails don't match<br>");
	}


	if(strlen($firstname_user) > 25 || strlen($firstname_user) < 2) {
		array_push($error_array_user, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lastname_user) > 25 || strlen($lastname_user) < 2) {
		array_push($error_array_user,  "Your last name must be between 2 and 25 characters<br>");
	}

	if($password_user != $password_user2) {
		array_push($error_array_user,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password_user)) {
			array_push($error_array_user, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password_user) > 30 || strlen($password_user) < 5) {
		array_push($error_array_user, "Your password must be between 5 and 30 characters<br>");
	}

	if($password_user == "password" OR $password_user2 == "password"){
		array_push($error_array_user, "Make your password more unique<br>");
	}



	if(empty($error_array_user)) {
		$password_user = md5($password_user); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username_user = strtolower($firstname_user . "_" . $lastname_user);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username_user'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username_user = $username_user . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username_user'");
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


		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$firstname_user', '$lastname_user', '$username_user', '$email_user', '$password_user', '$date_user', 'user','no','$profile_pic', '', '')");

		array_push($error_array_user, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

		//Clear session variables 
		$_SESSION['reg_firstname_user'] = "";
		$_SESSION['reg_lastname_user'] = "";
		$_SESSION['reg_email_user'] = "";
		$_SESSION['reg_email_user2'] = "";
	}

}
	
?>