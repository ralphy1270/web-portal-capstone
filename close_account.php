<?php
include("includes/header.php");

if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = mysqli_query($con, "UPDATE users SET archieved='yes' WHERE username='$loggedin_user'");
	session_destroy();
	header("Location: index.php");
}


?>

<div class="main_column column">

	<h4>Remove Account</h4>

	Are you sure you want to remove your account?<br><br>
	Removing your account will archive your profile and all your activity from the admin.<br><br>

	<form action="close_account.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Remove" class="danger settings_submit">
		<input type="submit" name="cancel" id="update_details" value="Cancel" class="default settings_submit">
	</form>

</div>

<script src="assets/js/register.js"></script>
<script src="js/custom.js"></script>