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
$health = "";
$sports = "";
$education = "";
$environment ="";
$legislation = "";
$contigency = "";  
$program = "";
$service = "";
$announcement = "";
$event ="";  
if(empty($_SESSION['recievearticle'])){
$_SESSION['submitarticle'] = "<input type='submit' class='info settings_submit' name='save' value='Save' style= 'margin: 1% 10% 1% 92%;'>";
$_SESSION['title'] = "";
$_SESSION['description'] = "";
$_SESSION['content'] = "";
$_SESSION['date'] = "";
$_SESSION['category'] = "";
$_SESSION['post_type'] = "";
$_SESSION['messagearticle'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up all data to add new article
      </div></div>";
$_SESSION['id'] = "";

$health = "";
$sports = "";
$education = "";
$environment ="";
$legislation = "";
$contigency = "";  
$program = "";
$service = "";
$announcement = "";
$event ="";  
}
if(isset($_GET['edit'])){
  $edit = $_GET['edit'];
  $ps_query = mysqli_query($con, "SELECT * FROM posts WHERE id='$edit'");
  $row = mysqli_fetch_array($ps_query);
  $title = $row['name'];
  $description = $row['position'];
  $content = $row['content'];
  $date = $row['date_added'];
  $post_type = $row['post_type'];
  $category = $row['category'];
  $_SESSION['idarticle'] = $edit;
  $_SESSION['title'] = $title;
  $_SESSION['description'] = $description;
  $_SESSION['content'] = $content;
  $_SESSION['date'] = $date;
  $_SESSION['category'] = $category;
  $_SESSION['post_type'] = $post_type;
  $_SESSION['submitarticle'] = "<input type='submit' class='info settings_submit' name='update' value='Update' style= 'margin: 1% 10% 1% 92%;'>";
  $_SESSION['messagearticle'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up forms to add new article post
      </div></div>";
}
if(isset($_POST['refresh-article'])){
  header("Location: articletab.php");
  $_SESSION['idarticle'] = "";
  $_SESSION['title'] = "";
  $_SESSION['description'] = "";
  $_SESSION['content'] = "";
  $_SESSION['date'] = "";
  $_SESSION['legislation'] = "";
  $_SESSION['contigency'] = "";
  $_SESSION['category'] = "";
  $_SESSION['submitarticle'] = "<input type='submit' class='info settings_submit' name='save' value='Save' style= 'margin: 1% 10% 1% 92%;'>";
  $_SESSION['messagearticle'] = "<div class='message'><div style='text-align:center;' class='alert alert-info'>
        Fill up all data to add new article
      </div></div>";

  $health = "";
  $sports = "";
  $education = "";
  $environment ="";
  $legislation = "";
  $contigency = "";  
  $program = "";
  $service = "";
  $announcement = "";
  $event ="";  
}
if(isset($_POST['view-article'])){
  header("Location: articletable.php");
}
$errorMessage = "";
if(isset($_POST['save'])){
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['description'] = $_POST['description'];
  $_SESSION['content'] = $_POST['body-content'];
  $_SESSION['date'] = $_POST['date-content'];
  $_SESSION['category'] = $_POST['selcat'];
  $_SESSION['post_type'] = $_POST['seltype'];
  $uploadOk = 1;
  $imageName = $_FILES['fileToUpload']['name'];
  $DownloadOk = 1;
  $downloadname = $_FILES['Downloadable_Form']['name'];
  $filename_download = $_FILES['Downloadable_Form']['name'];
  $errorMessage = "";

  if($imageName != "") {
    $targetDir = "assets/images/profile_pics/";
    $imageName = $targetDir . uniqid() . basename($imageName);
    $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

    if($_FILES['fileToUpload']['size'] > 10000000) {
      $errorMessage = "Sorry your file is too large";
      $uploadOk = 0;
    }

    if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
      $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
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

  if($downloadname != "") {
    $targetDir = "uploads/";
    $downloadname = $targetDir . uniqid() . basename($downloadname);
    $DownloadFileType = pathinfo($downloadname, PATHINFO_EXTENSION);

    if($_FILES['Downloadable_Form']['size'] > 10000000) {
      $errorMessage = "Sorry your file is too large";
      $DownloadOk = 0;
    }else {
      $downloadsize = $_FILES['Downloadable_Form']['size'];
    }

    if(strtolower($DownloadFileType) != "pdf" && strtolower($DownloadFileType) != "docx" && strtolower($DownloadFileType) != "pptx") {
      $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
      $DownloadOk = 0;
    }

    if($DownloadOk) {
      if(move_uploaded_file($_FILES['Downloadable_Form']['tmp_name'], $downloadname)) {
        //image uploaded okay
      }
      else {
        //image did not upload
        $DownloadOk = 0;
      }
    }
   
  }
  else {
    $downloadname = "";
    $downloadsize = "";
  }

  if($uploadOk) {
    if($DownloadOk == 0) {
      $errorMessage = "<div class='message'><div style='text-align:center;' class='alert alert-danger'>
          $errorMessage<div class='closebtn'>&times</div>
        </div></div>";
    }else {
      $post = new Post_Body($con);
      $errorMessage = $post->submitPost($_POST['title'], $_POST['description'], $_POST['body-content'], $_POST['date-content'], $_POST['seltype'],$_POST['selcat'], $imageName, $userLoggedIn, $downloadname, $downloadsize, $filename_download);
    }

  }
  else {
    $errorMessage = "<div class='message'><div style='text-align:center;' class='alert alert-danger'>
        $errorMessage<div class='closebtn'>&times</div>
      </div></div>";
  }

}

if(isset($_POST['update'])){

  $uploadOk = 1;
  $imageName = $_FILES['fileToUpload']['name'];
  $DownloadOk = 1;
  $downloadname = $_FILES['Downloadable_Form']['name'];
  $filename_download = $_FILES['Downloadable_Form']['name'];
  $errorMessage = "";

  if($imageName != "") {
    $targetDir = "assets/images/profile_pics/";
    $imageName = $targetDir . uniqid() . basename($imageName);
    $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

    if($_FILES['fileToUpload']['size'] > 10000000) {
      $errorMessage = "Sorry your file is too large";
      $uploadOk = 0;
    }

    if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
      $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
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

  if($downloadname != "") {
    $targetDir = "uploads/";
    $downloadname = $targetDir . uniqid() . basename($downloadname);
    $DownloadFileType = pathinfo($downloadname, PATHINFO_EXTENSION);

    if($_FILES['Downloadable_Form']['size'] > 10000000) {
      $errorMessage = "Sorry your file is too large";
      $DownloadOk = 0;
    }else {
      $downloadsize = $_FILES['Downloadable_Form']['size'];
    }

    if(strtolower($DownloadFileType) != "pdf" && strtolower($DownloadFileType) != "docx" && strtolower($DownloadFileType) != "pptx") {
      $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
      $DownloadOk = 0;
    }

    if($DownloadOk) {
      if(move_uploaded_file($_FILES['Downloadable_Form']['tmp_name'], $downloadname)) {
        //image uploaded okay
      }
      else {
        //image did not upload
        $DownloadOk = 0;
      }
    }
   
  }
  else {
    $downloadname = "";
    $downloadsize = "";
  }

  if($uploadOk) {
    if($DownloadOk == 0) {
      $errorMessage = "<div class='message'><div style='text-align:center;' class='alert alert-danger'>
      $errorMessage<div class='closebtn'>&times</div>
      </div></div>";
    }
    else {
      $post = new Post_Body($con);
      $errorMessage = $post->SubmitPost_Article_Update($_SESSION['idarticle'], $_POST['title'], $_POST['description'], $_POST['body-content'], $_POST['date-content'], $_POST['seltype'],$_POST['selcat'], $imageName, $userLoggedIn, $downloadname, $downloadsize, $filename_download);
    }
  }
  else {
    $errorMessage = "<div class='message'><div style='text-align:center;' class='alert alert-danger'>
        $errorMessage<div class='closebtn'>&times</div>
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
  	.article-main-page {
  		background-color: rgba(241, 241, 243,1);
  	}
  </style>
</head>
<body>
	<div class="article-main-page">
            <form action="articletab.php" method="POST" enctype="multipart/form-data">
            <?php echo $_SESSION['messagearticle']; ?>                
            <?php echo $errorMessage; ?>	
            <?php 
                if($_SESSION['category'] != ""){
                    if($_SESSION['category'] == "Health"){
                      $health="selected";
                    }
                    else {
                      $health = "d";
                    }

                    if($_SESSION['category'] == "Education"){
                      $education="selected";
                    }
                    else {
                      $education = "";
                    }

                    if($_SESSION['category'] == "Sports"){
                      $sports="selected";
                    }
                    else {
                      $sports = "";
                    }

                    if($_SESSION['category'] == "Environment"){
                      $environment="selected";
                    }
                    else {
                      $environment = "";
                    }

                    if($_SESSION['category'] == "Contigency"){
                      $contigency="selected";
                    }
                    else {
                      $contigency = "";
                    }

                    if($_SESSION['category'] == "Legislation"){
                      $legislation="selected";
                    }
                    else {
                      $legislation = "";
                    }
                }

                if($_SESSION['post_type'] != ""){
                    if($_SESSION['post_type'] == "Program"){
                      $program="selected";
                    }
                    else {
                      $program = "";
                    }

                    if($_SESSION['post_type'] == "Service"){
                      $service="selected";
                    }

                    else {
                      $service = "";
                    }

                    if($_SESSION['post_type'] == "Announcement"){
                      $announcement="selected";
                    }
                    else {
                      $announcement = "";
                    }

                    if($_SESSION['post_type'] == "Event"){
                      $event="selected";
                    }
                    else {
                      $environment = "";
                    }
                }      
             ?>

              <div class="form-group" style="margin: 1% 0 1% 83%;"> 
                <input type="submit" class="info settings_submit" name="refresh-article" value="Add New" style="display: inline-block; margin-right: 1rem;">
                <input type="submit" class="info settings_submit" name="view-article" value="View" style="display: inline-block;">
              </div>
              <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $_SESSION['title'];?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" id="description" value="<?php echo $_SESSION['description'];?>" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="body-content">Content:</label>
                  <textarea name="body-content" class="form-control" style="height: 30rem;"><?php echo $_SESSION['content'];?></textarea>
              </div>
                <div class="row"> 
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label for="date-content">Date:</label>
                        <input type="date" name="date-content" id="article-date-posted" class="form-control" style="width:20rem;">
                    </div>
                  </div>  
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="selcat">Select Post Type:</label>
                      <select class="form-control" name="selcat" id="selcat" style="width:20rem;">
                        <option <?php echo $program;?>>Program</option>
                        <option <?php echo $service;?>>Service</option>
                        <option <?php echo $announcement;?>>Announcement</option>
                        <option <?php echo $event;?>>Event</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">  
                    <div class="form-group">
                      <label for="seltype">Select Post Category:</label>
                      <select class="form-control" name="seltype" id="seltype" style="width:20rem;">
                        <option <?php echo $health;?>>Health</option>
                        <option <?php echo $education;?>>Education</option>
                        <option <?php echo $sports;?>>Sports</option>
                        <option <?php echo $environment;?>>Environment</option>
                        <option <?php echo $contigency;?>>Contigency</option>
                        <option <?php echo $legislation;?>>Legislation</option>
                      </select>
                    </div>
                  </div> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="selimg">Select Image (Required):</label>
                      <input type="file" class="form-control-file border" name="fileToUpload">
                    </div>
                  </div> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="Downloadable_Form">Select File - Downloadable Form (Optional):</label>
                      <input type="file" class="form-control-file border" name="Downloadable_Form">
                    </div>
                  </div> 
                  <div class="col-sm-4">
                    
                  </div> 
                </div>
                    <?php echo $_SESSION['submitarticle'];?>
              
              <script src="ckeditor_standard/ckeditor.js"></script>
              <script>
                CKEDITOR.replace('body-content');
              </script>
            </form>
    </div>  

<script>
	$('.closebtn').on('click',function () {
     $('.errormessage').css('display', 'none');
});
</script>

<script>
  document.getElementById("article-date-posted").defaultValue = "<?php echo $_SESSION['date']; ?>";
</script>
<?php  
include("footer.php");
?>