<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/PostCategory.php");
$date = "";
$errorMessage="no-error";
if(isset($_SESSION['username_applicant'])){
	$send_by = $_SESSION['username_applicant'];
}
if(isset($_POST['submit_botton'])){

	if(isset($_POST['request_category'])){
		$request_category = $_POST['request_category'];
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
		$targetDir = "uploads/";
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
		$check_empty = preg_replace('/\s+/', '', $DownloadName); //Deltes all spaces 
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
    <style type="text/css">
		body{
			background-color: #ffff;
		}
	</style>
</head>
</head>
<body>
<div class="request_message_success" style="display: <?php iPKqosHGXLFTwexcsjC+UXTkKV3GWWHwtzKz/ULb9ssM=","mode":"force-https","sts_include_subdomains":false,"sts_observed":1629962459.830114},{"expiry":1661327691.425091,"host":"PmHKo9+NfFu9AjQSxw3MoTtfuXIu9G3fM8KGQt4xie4=","mode":"force-https","sts_include_subdomains":false,"sts_observed":1629791691.425096},{"expiry":1661585692.18852,"host":"PszGCOiv5CcTVwE/y7qkzXq4sOl3jJUyCsVSaxsaHJg=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1630049692.188525},{"expiry":1661566398.077412,"host":"Px3JEnLhe4Rlv1dko7XKDgegcNd+pSbiSJTzchkVZkg=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1630030398.077416},{"expiry":1661561982.500186,"host":"P0U8PuMHZmwe23y4fSs3NhF+EibkzFvongWqsUNtk0k=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1630025982.500191},{"expiry":1661437394.139818,"host":"P1EvqsN2Q9uKcLGofz+lMvLj4U9b4/u5QgoRbJ3+HrY=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1629901394.139825},{"expiry":1645506495.015077,"host":"P4N3elPykCOF3xddnCKGzTbasIS3cyl7w7bYKfV29DA=","mode":"force-https","sts_include_subdomains":false,"sts_observed":1630040895.015081},{"expiry":1661568811.943127,"host":"Q2i8+5A3kREMoy37yPuUYKheqKsz3RQ2ENTog6mvPhc=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1630032811.943147},{"expiry":1661577946.789994,"host":"Q+FCtpiGM4NLKIfE4hEPfLkVmtda48FEGW4SDDtrSq0=","mode":"force-https","sts_include_subdomains":true,"sts_observed":1630041946.789999},{"expiry":1661590279.128963,"host":"RoBs9tFdbfQXd4NW5V81DLXpHKAegof/HbOojfjZobg=","mode":"force-https","sts_include_subdomains":false,"sts_observed":1630054279.128967},{"expiry"