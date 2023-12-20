<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");
include("includes/classes/Messages.php");
if(isset($_GET['downloadable_file'])){
  $downloadable_file = $_GET['downloadable_file'];
  header("Content-Disposition: attachment; filename=" .$downloadable_file);
  header("Content-Type: application/octet-stream;");
  readfile("../uploads/" .$downloadable_file);
  $con = null;
}
if (isset($_SESSION['username_applicant'])) {
  $userLoggedIn = $_SESSION['username_applicant'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
  $admin_type = $user['user_type'];
}
else {
  header("Location: register.php");
}

$message_inbox_obj = new Messages($con);


if(isset($_GET['u'])){
  $message_id = $_GET['u'];
}
else{
  $message_id = "new";
}

if($message_id != "new"){
  $query = mysqli_query($con, "SELECT * FROM messages WHERE id='$message_id'");
  $row = mysqli_fetch_array($query);
  $send_to_admin = $row['send_to_admin'];
  $date = $row['date'];

  $query_user = mysqli_query($con, "SELECT * FROM users WHERE username='$send_to_admin'");
  $row_user = mysqli_fetch_array($query_user);
  $first_name = $row_user['first_name'];
  $last_name = $row_user['last_name'];
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
</head>
<style type="text/css">
  body {
      background-color: rgba(241, 241, 243,1);
    }
</style>
<body>
  <div class="container-fluid">
    <div class="row message_tab_one">
      <div class="col-sm-4 for_inbox_outbox">
        <div class="inbox_message">
          <p>Inbox Messages</p> 
          <a href="messages_admin_user.php?u=new" class="message_tab_link">Sent Messages</a>
          <div class="posts_area">
            
          </div>
        </div>
      </div>
      <div class="col-sm-8 for_message_box">
        <div class="message_output_box">
          <div class="your_name_and_applicant">
             <?php if($message_id != "new"){echo "Sent by: " .$first_name. " " .$last_name . 
                   "<span style='font-size: 12px; margin-left: 10px; color: rgba(44, 62, 80,0.6); font-weight: bold;'>$date</span>" .
                      "<div class='new_message'>
                       <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#reply' style='padding: 2px 5px 2px 5px; margin: 5px;'>
                          Reply
                       </button>
                      </div>";}
                      else{
                        echo "Select Message";
                      }
              ?>
          </div>
          <div class="convo_output_box">
            <?php 
              if($message_id != "new"){
                echo $message_inbox_obj->messages_output_inbox_user($message_id);
              }
            ?>
          </div>
  
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script>

  $(document).ready(function() {

    $('#loading').show();
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_message_inbox_user.php",
      type: "POST",
      data: "page=1" + "&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    jQuery(function($) { 
            $('.inbox_message').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_message_inbox_user.php",
            type: "POST",
            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
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
