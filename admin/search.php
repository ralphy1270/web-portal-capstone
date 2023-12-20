<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");
include("includes/classes/Messages.php");
$str = "";
if (isset($_GET['q'])) {
  $query = $_GET['q'];
}              
if (isset($_GET['s'])) {
      $s = $_GET['s'];
      $query = mysqli_query($con, "SELECT * FROM forum WHERE id='$s' ORDER BY id DESC");

        while($row = mysqli_fetch_array($query)) {
          $id = $row['id'];
          $question = $row['question'];
          $ask_by = $row['ask_by'];
          $date = $row['date'];
          $opened = $row['opened'];
          $viewed = $row['viewed'];
          $answered = $row['answered'];

          $query_number_comment = mysqli_query($con, "SELECT * FROM comment WHERE question_id='$id'");
          $numberofcomment = mysqli_num_rows($query_number_comment);


          $query_user = mysqli_query($con, "SELECT * FROM users WHERE username='$ask_by'");
          $row_user = mysqli_fetch_array($query_user);
          $first_name = $row_user['first_name'];
          $last_name = $row_user['last_name'];
          $pic = $row_user['profile_pic'];
          $pic = str_replace('admin/', '', $pic);

          $str.= "<div id='comment_toggle$id' class='comment_toggle_forum'>
                <div class='row'>
                  <div class='col-md-1 applicants_question_img'>
                    <img src='$pic'>
                  </div>
                  <div class='col-md-11 applicants_question_question'>
                     $question
                  </div>  
                </div>
                
                <div class='applicants_question_name_date'>
                   $first_name $last_name &nbsp; $date
                </div>  
                <div style='margin: 0 0 0 10px'>
                  <p style='color: ; font-weight: bold;'>Comments ($numberofcomment)</p>
                </div>
                <hr>
              </div>  
            <iframe id='forum_comment$id' class='forum_comment' style='display:block;' src='comment_iframe.php?u=$id' scrolling='yes'></iframe>";
        }
}

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

<body style="overflow-y: auto;">
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
				<form action="search.php" class="search_form" method="POST">
					
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
				<div class="applicants_question" style="height: 62rem;">

					<div class="forum_loop posts_area">
            <?php 

            $value = "";
            if (isset($_GET['q'])) {
            echo $str . "<div style='font-size: 2rem; margin: 5rem 0 2rem 0; width:100%; text-align:center;'>
                            Related Question
                          </div>";
              $query = $_GET['q'];
              $str=array();
              $searchTerms = explode(" ", $query);
              $searchTermBits = array();
              $new = "";
              foreach ($searchTerms as $term) {
                  $query_user = mysqli_query($con, "SELECT * FROM forum WHERE question LIKE '%$term%'");
                    while($row = mysqli_fetch_array($query_user)) {
                      $id = $row['id'];
                      $question = $row['question'];
                      $ask_by = $row['ask_by'];
                      $date = $row['date'];
                      $opened = $row['opened'];
                      $viewed = $row['viewed'];
                      $answered = $row['answered'];

                      $query_number_comment = mysqli_query($con, "SELECT * FROM comment WHERE question_id='$id'");
                      $numberofcomment = mysqli_num_rows($query_number_comment);


                      $query_user_new = mysqli_query($con, "SELECT * FROM users WHERE username='$ask_by'");
                      $row_user_new = mysqli_fetch_array($query_user_new);
                      $first_name = $row_user_new['first_name'];
                      $last_name = $row_user_new['last_name'];
                      $pic = $row_user_new['profile_pic'];
                      $pic = str_replace('admin/', '', $pic);


                      $new = "<div id='comment_toggle$id' class='comment_toggle_forum'>
                            <div class='row'>
                              <div class='col-md-1 applicants_question_img'>
                                <img src='$pic'>
                              </div>
                              <div class='col-md-11 applicants_question_question'>
                                 $question
                              </div>  
                            </div>
                            
                            <div class='applicants_question_name_date'>
                               $first_name $last_name &nbsp; $date
                            </div>  
                            <div style='margin: 0 0 0 10px'>
                              <p style='color: ; font-weight: bold;'>Comments ($numberofcomment)</p>
                            </div>
                            <hr>
                          </div>  
                        <iframe id='forum_comment$id' class='forum_comment' style='display:block;' src='comment_iframe.php?u=$id' scrolling='yes'></iframe>";

                          if(!in_array($new, $str)) {
                            array_push($str, $new);
                          }
                    }

              }

              foreach($str as $value){
                 echo $value;
              }
            }

            ?>

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



