<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Table.php");
$user_table = new Post($con);

if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
}
else {
  header("Location: register.php");
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
</head>
<body>
	<div class="table-section table-user">
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th style="text-align: center;">Button</th>
		        <th>Firstname</th>
		        <th>Lastname</th>
		        <th>Username</th>
		        <th>Email</th>
		        <th>Sign-up Date</th>
		        </tr>
		    </thead>
		    <tbody class="posts_area_2">
		        
		    </tbody>
		</table>
    </div>     
    <div class="posts_area_script_user">

	</div>      
</body>
</html>

<script>

  $(document).ready(function() {

    $('#loading').show();
    var useropen = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_2.php",
      type: "POST",
      data: "page=1" + "&useropen=" + useropen,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_2').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-user').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_2').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_2').find('.nextPage').val();
      var noMorePosts = $('.posts_area_2').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_2.php",
            type: "POST",
            data: "page=" + page + "&useropen=" + useropen,
            cache:false,

            success: function(response) {
              $('.posts_area_2').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_2').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_2').append(response);
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
    var useropen = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_user_script.php",
      type: "POST",
      data: "page=1" + "&useropen=" + useropen,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_script_user').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-user').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_script_user').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_script_user').find('.nextPage').val();
      var noMorePosts = $('.posts_area_script_user').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_user_script.php",
            type: "POST",
            data: "page=" + page + "&useropen=" + useropen,
            cache:false,

            success: function(response) {
              $('.posts_area_script_user').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_script_user').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_script_user').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>