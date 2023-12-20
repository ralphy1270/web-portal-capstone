<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Table.php");
include("includes/classes/Messages.php");

if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
  $admin_type = $user['user_type'];
}
else {
  header("Location: register.php");
}

 ?>

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

</head>
<body data-spy="scroll" onload="startTime();timedate();">

<div class="top_bar"> 
    <img src="assets/images/icons/logo.png">
    <div class="logo">
      <a href="index.php"><?php 
        if($admin_type=="super admin"){
          echo "Super Admin";
        }
        else {
          echo "Admin";
        }

       ?></a>
    </div> 
    <div id="date-design" onload="timedate()">
          <span id="days"></span>  
          <span id="month"></span>
          <span id="date"></span>  
          <span id="year"></span>
          <div class="time">  
            <span  id="txt"></span>
          </div>
    </div>
    <nav>
      <a href="#" tabindex="1" data-original-title="<strong>Position:</strong>" data-html="true" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-content="<?php if($user['position'] == ""){ echo "N/A"; } else { echo $user['position'];} ?>">
        <?php echo $user['first_name'] . " " . $user['last_name'];?>
      </a>
      <a href="index.php" tabindex="2">
        <i class="fa fa-home fa-lg"></i>
      </a>
      <a href="javascript:void(0);" tabindex="3" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
        <i class="fa fa-envelope fa-lg"></i>
      </a>
<!--      <a href="#" tabindex="4">
        <i class="fa fa-bell fa-lg"></i>
      </a>-->
      <a href="settings.php" tabindex="5">
        <i class="fa fa-cog fa-lg"></i>
      </a>
      <a href="includes/handlers/logout.php" tabindex="6">
        <i class="fa fa-sign-out fa-lg"></i>
      </a>



    </nav>

    <div class="dropdown_data_window" style="height:0px; border:none;"></div>
    <input type="hidden" id="dropdown_data_type" value="">
  </div>

<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
  <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() {

    $('.dropdown_data_window').scroll(function() {
      var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
      var scroll_top = $('.dropdown_data_window').scrollTop();
      var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
      var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

      if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

        var pageName; //Holds name of page to send ajax request to
        var type = $('#dropdown_data_type').val();


        if(type == 'notification')
          pageName = "ajax_load_notifications.php";
        else if(type == 'message')
          pageName = "ajax_load_messages.php"


        var ajaxReq = $.ajax({
          url: "includes/handlers/" + pageName,
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
            $('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 


            $('.dropdown_data_window').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });

  </script>

 