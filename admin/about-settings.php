<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");

if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
}
else {
  header("Location: register.php");
}
$message = "";
$user_data_query = mysqli_query($con, "SELECT * FROM about");
	$row = mysqli_fetch_array($user_data_query);
	$id =$row['id'];
	$address =$row['address'];
	$contact =$row['contact'];
	$email =$row['email'];
	$mission =$row['mission'];
	$vision =$row['vission'];
	$general_info =$row['general_info'];
	$fb =$row['fb'];
	$ig =$row['ig'];
	$info_footer =$row['info_footer'];
	$Additional =$row['additional'];
	$Additionals =$row['additional_services'];

if(isset($_POST['update'])){


	$address =$_POST['address'];
	$contact =$_POST['telno'];
	$email =$_POST['email'];
	$mission =$_POST['mission'];
	$vision =$_POST['vision'];
	$general_info =$_POST['gen_info'];
	$fb =$_POST['fb'];
	$ig =$_POST['ig'];
	$Additional =$_POST['body-content'];
	$Additionals =$_POST['body-contents'];
	$info_footer =$_POST['info_footer'];
	if(mysqli_num_rows($user_data_query) > 0) {
		$query = mysqli_query($con, "UPDATE about SET address='$address',contact='$contact',email='$email',mission='$mission',vission='$vision',general_info='$general_info',fb='$fb',ig='$ig',additional='$Additional', additional_services ='$Additionals', info_footer='$info_footer' WHERE id='$id'");
		$message = "<div class='message'><div style='text-align:center;' class='alert alert-success'>
        Successfully Updated!<div class='closebtn'>&times</div>
      </div></div>";
	}
	else {
		$query = mysqli_query($con, "INSERT INTO about VALUES('', '$address', '$contact', '$email', '$mission', '$vision', '$general_info', '$fb', '$ig', '$info_footer', 'Additional' ,'$Additionals')");
		$message = "<div class='message'><div style='text-align:center;' class='alert alert-success'>
        Success!<div class='closebtn'>&times</div>
      </div></div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Super Admin - Youth and Sports Development of Sta. Cruz,Laguna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/icons/logo.ico">

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
  		background-color: rgba(241, 241, 243,1);
  	}
  </style>
</head>
<body>
	<div class="about-main-page">
		<form action="about-settings.php" method="POST">
		
		
		<div style="text-align:center;" class="alert alert-info">Save or Update to Change the About page Info</div>
		<?php echo $message; ?>
		  <div class="form-group">
	        <label for="gen_info">General Informaton:</label>
	        <textarea name="gen_info" class="form-control"><?php echo $general_info; ?></textarea>
	      </div>

	      <div class="form-group">
	        <label for="mission">Mission:</label>
	        <textarea name="mission" class="form-control"><?php echo $mission; ?></textarea>
	      </div>

	      <div class="form-group">
	        <label for="vision">Vision:</label>
	        <textarea name="vision" class="form-control"><?php echo $vision; ?></textarea>
	      </div>
		      <div class="row"> 
			      <div class="col-sm-4">
			      	<div class="form-group">
			            <label for="fb">Facebook link:</label>
			            <input type="text" name="fb" value="<?php echo $fb; ?>" id="fb" class="form-control" style="width:20rem;" autocomplete="off">
			            <br><br>
			        </div>
			      </div>  
			      <div class="col-sm-4">
			        <div class="form-group">
			            <label for="telno">Telephone Number:</label>
			            <input type="text" name="telno" value="<?php echo $contact; ?>" id="telno" class="form-control" style="width:20rem;" autocomplete="off">
			        </div>
			      </div>  
			      <div class="col-sm-4">
			        <div class="form-group">
			            <label for="email">Email:</label>
			            <input type="text" name="email" value="<?php echo $email; ?>" id="email" class="form-control" style="width:20rem;" autocomplete="off">
			            <br><br>
			        </div>
			      </div>
			      <div class="col-sm-4">
			        <div class="form-group">
			            <label for="ig">Instagram link:</label>
			            <input type="text" name="ig" id="ig" value="<?php echo $ig; ?>" class="form-control" style="width:20rem;" autocomplete="off">
			            <br><br>
			        </div>	
			      </div>
			      <div class="col-sm-4">	      	
			        <div class="form-group">
			            <label for="info_footer">Information on footer:</label>
			            <textarea name="info_footer" class="form-control"><?php echo $info_footer; ?></textarea>
			        </div>
			      </div>
			      <div class="col-sm-4">	      	
			        <div class="form-group">
			            <label for="address">Address:</label>
			            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
			        </div>
			      </div>
			  </div> 
		    <div class="form-group">
	          <label for="body-content">Additional Information - About page (Optional):</label>
	          <textarea name="body-content" class="form-control" style="height: 30rem;"><?php echo $Additional; ?></textarea>
	        </div>
	        <div class="form-group">
	          <label for="body-contents">Additional Information - Services page (Optional):</label>
	          <textarea name="body-contents" class="form-control" style="height: 30rem;"><?php echo $Additionals; ?></textarea>
	        </div>
	        <div class="form-group">
		       <input type="submit" class="info settings_submit" name="update" value="Save/Update" style="float: right; margin: 1rem 3rem 0 0;">
		    </div> 
	      <script src="ckeditor_standard/ckeditor.js"></script>
	      <script>
	        CKEDITOR.replace('body-content');
	      </script>
	      <script>
	        CKEDITOR.replace('body-contents');
	      </script>
		</form>
	</div>
<script>
	$('.closebtn').on('click',function () {
     $('.message').css('display', 'none');
});
</script>	
<?php  
include("footer.php");
?>