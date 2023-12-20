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
if(empty($_SESSION['recieve'])){
$_SESSION['submit'] = "<input type='submit' class='info settings_submit' name='save' value='Save' style= 'margin: 1% 10% 1% 92%;'>";
$_SESSION['name'] = "";
$_SESSION['position'] = "";
$_SESSION['message'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up all data to insert new public servant
      </div></div>";
$_SESSION['id'] = "";
}
if(isset($_GET['edit'])){
  $edit = $_GET['edit'];
  $ps_query = mysqli_query($con, "SELECT * FROM public_servants WHERE id='$edit'");
  $row = mysqli_fetch_array($ps_query);
  $name = $row['name'];
  $position = $row['position'];
  $_SESSION['id'] = $edit;
  $_SESSION['name'] = $name;
  $_SESSION['position'] = $position;
  $_SESSION['picture'] = $picture;
  $_SESSION['submit'] = "<input type='submit' class='info settings_submit' name='update' value='Update' style= 'margin: 1% 10% 1% 92%;'>";
  $_SESSION['message'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up forms to add new public servant
      </div></div>";
}
if(isset($_POST['refresh'])){
  header("Location: public-servants.php");
  $_SESSION['name'] = "";
  $_SESSION['position'] = "";
  $_SESSION['submit'] = "<input type='submit' class='info settings_submit' name='save' value='Save' style= 'margin: 1% 10% 1% 92%;'>";
  $_SESSION['message'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up all data to add new public servant
      </div></div>";
  $_SESSION['id'] = "";
}
if(isset($_POST['view'])){
  header("Location: view-public-servants-table.php");
}
$errorMessageps = "";
if(isset($_POST['save'])){
  $_SESSION['name'] = $_POST['name-ps'];
  $_SESSION['position'] = $_POST['position-ps'];
  
  $uploadOk = 1;
  $imageName = $_FILES['fileToUpload']['name'];
  $errorMessageps = "";

  if($imageName != "") {
    $targetDir = "assets/images/profile_pics/";
    $imageName = $targetDir . uniqid() . basename($imageName);
    $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

    if($_FILES['fileToUpload']['size'] > 10000000) {
      $errorMessageps = "Sorry your file is too large";
      $uploadOk = 0;
    }

    if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
      $errorMessageps = "Sorry, only jpeg, jpg and png files are allowed";
      $uploadOk = 0;
    }

    if($uploadOk) {
      if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
        //image uploaded okay
      }
      else {
        //image did not upload
        $uploadOk = 0;
      }
    }
   
  }

  if($uploadOk) {
    $post = new Post_Body($con);
    $errorMessageps = $post->SubmitPost_Public_Servant($_POST['name-ps'], $_POST['position-ps'], $imageName);

  }
  else {
    $errorMessageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
        $errorMessageps<div class='closebtn'>&times</div>
      </div></div>";
  }

}

if(isset($_POST['update'])){

  $uploadOk = 1;
  $imageName = $_FILES['fileToUpload']['name'];
  $errorMessageps = "";

  if($imageName != "") {
    $targetDir = "assets/images/profile_pics/";
    $imageName = $targetDir . uniqid() . basename($imageName);
    $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

    if($_FILES['fileToUpload']['size'] > 10000000) {
      $errorMessageps = "Sorry your file is too large";
      $uploadOk = 0;
    }

    if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
      $errorMessageps = "Sorry, only jpeg, jpg and png files are allowed";
      $uploadOk = 0;
    }

    if($uploadOk) {
      if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
        //image uploaded okay
      }
      else {
        //image did not upload
        $uploadOk = 0;
      }
    }
   
  }

  if($uploadOk) {
    $post = new Post_Body($con);
    $errorMessageps = $post->SubmitPost_Public_Servant_Update($_SESSION['id'],$_POST['name-ps'], $_POST['position-ps'], $imageName);

  }
  else {
    $errorMessageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
        $errorMessageps<div class='closebtn'>&times</div>
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
  	.public-servants-main-page {
  		background-color: rgba(241, 241, 243,1);
  	}
  </style>
</head>
<body>
	<div class="public-servants-main-page">
            <form action="public-servants.php" method="POST" enctype="multipart/form-data">
            <?php echo $_SESSION['message']; ?>  
            <?php echo $errorMessageps; ?>	
              <div class="form-group" style="margin: 1% 0 1% 83%;"> 
                <input type="submit" class="info settings_submit" name="refresh" value="Add New" style="display: inline-block; margin-right: 1rem;">
                <input type="submit" class="info settings_submit" name="view" value="View" style="display: inline-block;">
              </div>
              <div class="form-group">
                <label for="name-ps">Public Servant Full Name:</label>
                <input type="text" name="name-ps" class="form-control" id="name-ps" value="<?php echo $_SESSION['name']; ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="position-ps">Public Servant Position:</label>
                <input type="text" name="position-ps" class="form-control" id="position-ps" value="<?php echo $_SESSION['position']; ?>" autocomplete="off">
              </div>
              
                
              <div class="form-group">
                <label for="selimg">Select Image (Required):</label>
                <input type="file" class="form-control-file border" name="fileToUpload">
              </div>
            
              <?php echo $_SESSION['submit'] ?>
    </div>        
<script>
	$('.closebtn').on('click',function () {
     $('.errormessage').css('display', 'none');
});
</script>
<?php  
include("footer.php");
?>