<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Table.php");
$user_table = new Post($con);
/*$query = mysqli_query($con, "INSERT INTO public_servants VALUES('', 'Eliza Lo', 'Test', 'Test')");*/
if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
}
else {
  header("Location: register.php");
}
if(isset($_POST['back'])){
  header("Location: public-servants.php");
}
if(isset($_POST['edit'])){
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
        Press Update Button to edit: Public Servant ID number $edit ($name:$position) 
      </div></div>";
  $_SESSION['recieve'] = "yes";    
  header("Location: public-servants.php");
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/icons/logo.ico">

  <!-- Javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/bootbox.min.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/jquery.jcrop.js"></script>
  <script src="assets/js/jcrop_bits.js"></script>


  <!-- CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
  	<div class="table-section table-archive">
  		<table class="table table-hover">
  		    <thead>
  		      <tr>
  		        <th>ID</th>
  		        <th style="text-align: center;">Action</th>
  		        <th>Name</th>
  		        <th>Position</th>
  		        </tr>
  		    </thead>
  		    <tbody class="posts_area_ps">
  		        
  		    </tbody>
  		</table>
      </div>     
      <div class="posts_area_script_archive">

  	</div>   
    <form action="view-public-servants-table.php" method="POST">
    <input type="submit" class="info settings_submit" name="back" value="Back" style="display: inline-block; margin-top: 1rem;">
    </form>
  </div>   
</body>
</html>

<script>

  $(document).ready(function() {

    $('#loading').show();
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_public_servants.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_ps').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-section').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_ps').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_ps').find('.nextPage').val();
      var noMorePosts = $('.posts_area_ps').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_public_servants.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area_ps').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_ps').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_ps').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>


  <script>

  $(document).ready(function() {

    $('#loading').show();
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_public_servants_script.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_script_archive').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-archive').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_script_archive').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_script_archive').find('.nextPage').val();
      var noMorePosts = $('.posts_area_script_archive').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_public_servants_script.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area_script_archive').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_script_archive').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_script_archive').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>