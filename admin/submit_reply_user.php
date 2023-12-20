<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");
include("includes/classes/Messages.php");
$date = "";
$errorMessage="no-error";

if(isset($_SESSION['username_applicant'])){
	$send_by = $_SESSION['username_applicant'];
}
if(isset($_POST['submit_botton'])){

	if(isset($_POST['suggestion_ta'])){
		if(isset($_POST['request_category'])){
			$request_category = $_POST['request_category'];
		}
		else{
			$request_category ="";
		}	
		if($_POST['suggestion_ta'] != ""){
			$suggestion_ta = $_POST['suggestion_ta'];
		}
		else{
			$suggestion_ta = "";
		}


		$DownloadOk = 1;
		$DownloadName = $_FILES['Downloadable_Form']['name'];
		$downloadname_screen = $_FILES['Downloadable_Form']['name'];
		$DownloadSize = $_FILES['Downloadable_Form']['size'];
		$errorMessage = "";

		if($DownloadName != "") {
		$targetDir = "../uploads/";
		$DownloadName = $targetDir . uniqid() . basename($DownloadName);
		$DownloadFileType = pathinfo($DownloadName, PATHINFO_EXTENSION);

		if($_FILES['Downloadable_Form']['size'] > 10000000) {
		  $errorMessage = "Sorry your file is too large";
		  $DownloadOk = 0;
		}
		else {
			$DownloadSize = $_FILES['Downloadable_Form']['size'];
		}

		if(strtolower($DownloadFileType) != "pdf" && strtolower($DownloadFileType) != "docx" && strtolower($DownloadFileType) != "pptx" && strtolower($DownloadFileType) != "xlsx") {
		  $DownloadOk = 0;
		}

		if($DownloadOk) {
		  if(move_uploaded_file($_FILES['Downloadable_Form']['tmp_name'], $DownloadName)) {
		    //image uploaded okay
		  }
		  else {
		    //image did not upload
		    $DownloadOk = 0;
		  }
		}

		}

		if($DownloadOk) {
		$post = new Submit_Forms($con);
		$errorMessage = $post->Downloadale_Post($DownloadName, $DownloadSize,$request_category, $suggestion_ta,$send_by,$downloadname_screen);
		}
		
	}
	else {
		
	}	
}

class Submit_Forms {
	private $user_obj;
	private $con;

	public function __construct($con){
		$this->con = $con;
	}
	public function Downloadale_Post($file_name, $DownloadSize, $request_category, $suggestion_ta,$send_by,$downloadname_screen){
		$DownloadSize = number_format($DownloadSize/1024/1024,2) . "MB";
		$message = "";
		$DownloadName = $file_name;
		$DownloadName = ucfirst($DownloadName);
		$DownloadName = str_replace('\r\n', "\n", $DownloadName);
		$DownloadName = nl2br($DownloadName);
		$check_empty = preg_replace('/\s+/', '', $suggestion_ta); //Deltes all spaces 
		if($check_empty != "") {
			$date = date("Y-m-d"); //Current date
			$query = mysqli_query($this->con, "INSERT INTO messages VALUES ('', '$request_category', '$suggestion_ta', '$DownloadName', '$DownloadSize' , 'no', 'no', '$date','$send_by','','','$downloadname_screen')");
			$message = "";
		}
		else {
			$message = "Error! Incomplete Input";
		}
		return $message;
	}
}	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<head>
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
		body{
			background-color: #ffff;
		}
	</style>
</head>
<body>
<div class="request_message_success" style="display: <?php if($errorMessage == ""){echo "block;";} ?>">
		Request Sent!
</div>
<div class="request_message_error" style="display: <?php if($errorMessage != ""){echo "block;";} ?>">
		<?php if($errorMessage=="no-error"){}else{echo $errorMessage;} ?>
</div>
<br>
<div class="submitforms_form">
	<form action="submit_reply_user.php? ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
		  <label for="sel1" style="color: rgba(17, 82, 114, 0.9); font-weight: bold;">Process:</label>
		  <br><br>
		    <select class="form-control" id="category" name="request_category">
		      <option disabled selected value> -- Select your request -- </option>
		      <option>Financial Assistance to Youth: Academic and Extracurricular Activites and Events</option>
		      <option>Sanguiniang Kabataan Request: Financial</option>
		      <option>Sanguiniang Kabataan Request: Sports Related</option>
		      <option>Sanguiniang Kabataan Request: Civic Activites</option>
		      <option>Sanguiniang Kabataan Request: Machineries and Equipment</option>
		      <option>Informative Request: Interviews</option>
		      <option>Informative Request: Research Studies</option>
		      <option>Event Partnership Request</option>

		      <option disabled selected value> -- Select File to submit -- </option>
		      <option>Request Letter & Proof of Event/Competition</option>
		      <option>Request Letter & Activity Proposal Letter</option>
		      <option>Financial Request Letter</option>
		    </select>
	  	</div>
	    <div class="form-group">
		   <textarea class="form-control" name="suggestion_ta" rows="2" id="suggestion_ta" placeholder="Add Message..."></textarea>
		</div>
		<div class="form-group">
          <label for="Downloadable_Form" style="color: rgba(17, 82, 114, 0.9); font-weight: bold;">Select File (Optional):</label>
          <input type="file" class="form-control-file border" name="Downloadable_Form">
        </div>
		<input type="submit" id="request_botton_user" class="submitforms_botton default settings_submit" name="submit_botton" value="Submit">
		<br>
	</form>
	
</div>	
</body>
</html>

<script>
	$('.request_message_success').delay(2000).fadeOut();
</script>
<script>
	$('.request_message_error').delay(2000).fadeOut();
</script>