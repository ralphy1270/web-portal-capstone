<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");
include("includes/classes/Messages.php");

if (isset($_SESSION['username_applicant'])) {
  $userLoggedIn = $_SESSION['username_applicant'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
  $admin_type = $user['user_type'];
}
else if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
    $admin_type = $user['user_type'];
}
else {
  header("Location: register.php");
}

if (isset($_POST['send'])) {
	if($_POST['question'] != ""){
		$question = $_POST['question'];
		$date = date("Y-m-d"); //Current date
		$query = mysqli_query($con, "INSERT INTO forum VALUES('', '$question', '$userLoggedIn', '$date', 'no','no','no')");
		$no_error="yes";
		$success="yes";
	}
	else{
		
	}

}
else {
	$no_error="no";
}
?>


<!DOCTYPE html>
<html>
 <head>
  <title>Forum - Youth and Sports Development of Sta. Cruz,Laguna</title>
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
  <script>
							
	$(document).ready(function() {

	  //On click signup, hide login and show registration form
	  $("#click_to_send").click(function() {
	      if($('#question_asked_forum_send_form').css('display') == 'none'){
	        $("#question_asked_forum_send_form").slideDown("fast");
	      }
	      else {
	        $("#question_asked_forum_send_form").slideUp("fast");
	      }
	  });
	});
  $(document).ready(function() {

    $('#loading').show();
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_forum.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    jQuery(function($) { 
       /*     $('.question_comment_section_box').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { */
    $(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() == $(document).height()) {                	

      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_forum.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>

  <!-- CSS -->
 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 
 <!--<link rel="stylesheet" type="text/css" href="js/font-awesome.min.css"></script>-->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <style type="text/css">
  	body {
  		background-color: #ffff;
  	}
  </style>

</head>

<body>
<div class="container-fluid">
<div class="row forum_section">
	<div class="col-md-2 related_section">

	</div>
	<div class="col-md-8 question_comment_section">
		<div class="question_comment_section_box">

			<div class="form_forum_div search input-group mb-3" style="">		
				<form action="search.php" action="GET">
					<input type="text" class="form-control" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input" style="width: 67rem;border-radius:3px 0 0 3px;">
					<div class="input-group-append" style="display: inline-block;">
					   <button class="btn btn-primary" type="submit" class="button_holder" style="border-radius: 0 5px 5px 0;">Search</button>
					</div>
					<div class="search_results">
					</div>
					<div class="search_results_footer_empty">
					</div>
				</form>
			</div>

			<div class="form_forum">
				<form action="forum.php" class="search_form" method="POST">
					
					<div id="question_asked_forum" title="Click to ask question" style="width: auto; display: table;">
						<div id="click_to_send">
							Ask question <i class="fa fa-comments-o" aria-hidden="true"></i>
						</div>
						<p class="success_sent" style="display: none; margin-top: 5px; color: green;">
							Question Sent!
						</p>
					</div>
					<div id="question_asked_forum_send_form" style="display: <?php if($no_error == "no"){echo "none;";}if($no_error == "yes") {echo "block;";} ?>">
						<div class="form_forum_div input-group mb-3" style="">
						  <textarea class="form-control" placeholder="Add questions..." style="width: 100%;" name="question"></textarea>
						  <div class="input-group-append" style="">
						    <button class="btn btn-primary" type="submit" name="send" style="margin: 5px 0 0 683px;">Send</button>
						  </div>
						</div>
					</div>
				</form>
			</div>
			<div>
				<div class="applicants_question">

					<div class="forum_loop posts_area">


					</div><!-- End forum loop -- >						
				</div>
			</div>
			

	
		</div>

	</div>
	<div class="col-md-2 related_section">
		
	</div>
</div>
</div>
</body>
</html>



