<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/PostCategory.php");

$user_obj = new Post($con);
$get_obj = new User($con);
$get_category = new PostCategory_Content($con);

$error_array_user = array(); //Holds error messages
?>
<!DOCTYPE html>
<html lang="en">
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
</head>

<style>
	a.home {
		background-color: rgba(241, 196, 15,1.0);
		color:#ffffff;
	}
</style>

<body onload="startTime();timedate();">
<!--- Navigation -->
<div id="menubar" class="theverytopmenu">
	<div class="menubar">
    	<div class="container-fluid">
<!-- DATE/TIME -->
			<div class="menubar-button" onclick="openNav()">
				<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
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
<!-- END DATE/TIME -->
			<div class="page-logo">
		    	<img src="assets/images/icons/logo.png" alt="Logo">	
            </div>		
			<ul class="menubar-nav ml-auto">
				<li class="menu-item">
					<a class="menu-link homepage" href="index.php">Home</a>
				</li>
				<li class="menunav-item">
					<a class="menu-link aboutpage" href="about-us.php">About</a>
				</li>
				<li class="menu-item">
					<a class="menu-link programspage" href="programs.php">Programs</a>
				</li>
				<li class="menu-item">
					<a class="menu-link eventspage" href="events.php">Events</a>
				</li>
				<li class="menu-item">
					<a class="menu-link forumpage" href="forum.php">Forum</a>
				</li>
			</ul>		
		</div>
    </div> <!--- End MenuBar class -->
<!-- Start Menu-Botton -->
    <div class="menu-bottom">
<!--		<form class="search">
			   <input type="text" name="search" placeholder="Search..." autocomplete="off">
		</form>-->

	    <div class="other-platforms">
		   <span class="contact"><a href="tel:<?php echo $get_obj->contact(); ?>">Contact us</a></span>
		   <span class="social-link"><a href="<?php echo $get_obj->fb(); ?>"><i class="fab fa-facebook-f"></i></a>
		   </span>
		   <?php 

		   		if(isset($_SESSION['username_applicant'])){
		   			?>
		   			<span class="social-link">
				   		<a href="messages_user.php?">
				   			<i class="fa fa-envelope" aria-hidden="true" style="font-size: 20px; margin-bottom: -3px;"></i>
				   		</a>
				   </span>
				<?php
		   		}

		    ?>
		   
		   <?php  
		   if(isset($_SESSION['username_applicant'])){
		     $loggedin_user = $_SESSION['username_applicant'];
		     $query = mysqli_query($con, "SELECT profile_pic,first_name,last_name FROM users WHERE username ='$loggedin_user'");
		     $row = mysqli_fetch_array($query);
		     $profile_pic = $row['profile_pic'];
		     $first_name = $row['first_name'];
		     $last_name = $row['last_name'];
		     ?>
		     <div class="dropdown" style="width: auto;">
			  <img src="<?php echo $profile_pic;?>" onclick="myFunction()" class="dropbtn">
			  <div id="myDropdown" class="dropdown-content loggedin_dropdown">
			    <p style="text-align: center;"><?php echo $first_name . "&nbsp" . $last_name;?></p>
			    <hr style="margin: 0; padding: 0;">
		<!--	    <a href="activity_user.php">Activity</a> -->
			    <a href="settings.php">Settings</a>
			    <a href="includes/handlers/logout.php">Logout</a>
			  </div>
			</div>
			<?php
			}
			else{
				?>
				<div class="dropdown" style="width: 5.6rem;">
				  <button onclick="myFunction()" class="dropbtn">Sign In</button>
				  <div id="myDropdown" class="dropdown-content" style="overflow: hidden;">
				    <a href="login.php">Login</a>
				    <hr style="margin: 0; padding: 0;">
				    <a href="register.php" style="overflow: hidden;">Register</a>
				  </div>
				</div>
				<?php
			}
			?>
		</div>
	</div><!-- End Menu-Bottom -->	
</div> <!--- End of MenuBar id -->



<div class="request_icon" id="request_icon">
	<div class="request_description" id="request_description">
		Click for request!
	</div>
	<a href="javascript:void(0);" onclick="getDropdownDataRequest('<?php echo $loggedin_user; ?>', 'request')" data-toggle="modal" <?php if(isset($_SESSION['username_applicant'])){ }else{echo "data-target='#request_modal'";} ?>>
		<img src="assets/images/icons/request_icon.png">
	</a>
	
</div>
<!-- Start Side-Nav -->	
<div id="mySidenav" class="sidenav"> 
	<a class="home" href="index.php">Home</a>
	<a class="about" href="about-us.php">About</a>
	<a class="programs" href="programs.php">Programs</a>
	<a class="services" href="services.php">Services</a>
	<a class="forum" href="forum.php">Forum</a>
</div><!-- End Side-Nav -->

<div class="submitforms_box">
	<div class="close_messagebox" onclick="getDropdownDataRequest('<?php echo $loggedin_user; ?>', 'submitforms')" onClick='document.getElementById("submitforms").src="submitforms.php";'>
	  <i class="fa fa-times" aria-hidden="true"></i>
	</div>
	<br><br>
	<iframe src='submitforms.php' id ='submitforms' scrolling='no'></iframe>
</div>

<div class="message_box">
	<div class="close_messagebox" onclick="getDropdownDataRequest('<?php echo $loggedin_user; ?>', 'request')" onClick='document.getElementById("request_message").src="request_message.php";'>
	  <i class="fa fa-times" aria-hidden="true"></i>
	</div>
	<br><br>
	<iframe src='request_message.php' id ='request_message' scrolling='no'></iframe>
</div>

<!-- The Modal -->
  <div class="modal fade" id="request_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Login your account to send request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <iframe src="login_modal.php"></iframe>
        </div>
        
      </div>
    </div>
  </div>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script>
$(document).ready(function(){
  $("#request_icon").hover(function(){
    $("#request_description").css("display", "block");
    }, function(){
    $("#request_description").css("display", "none");
  });
});
</script>


<script>
	setInterval(function(){ 
    doBounce($("#request_icon"), 2, '10px', 200);
}, 7000);
	$("#request_icon").click(function() {
    doBounce($(this), 3, '10px', 300);   
});


function doBounce(element, times, distance, speed) {
    for(var i = 0; i < times; i++) {
        element.animate({marginTop: '-='+distance}, speed)
            .animate({marginTop: '+='+distance}, speed);
    }        
}
</script>
