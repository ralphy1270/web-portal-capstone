<?php 
include("includes/header.php");
if($user['user_type'] == "super admin"){

  header("Location: index.php");
}
  
 ?>

<div class="second-nav">
  <div class="menubar-admin-button" title="Dashboard Menu Option">
    <div style="font-size:30px;cursor:pointer" class="openbtn" onclick="openNav()">&#9776;</div>
  </div>
</div>

<div class="wrapper">
<!--  $query = mysqli_query($con, "INSERT INTO users VALUES ('', 'Profile', 'Test', 'clone', 'clone', 'clone', '2020-4-20', 'unapprove','no','assets/images/profile_pics/defaults/head_deep_blue.png', '','')"); -->
<div id="mySidenav" class="sidenav" style="width: 200px;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <p>Menu</p>
    <div class="tab" id="tab">
     
      <button class="tablinks active" id="postoptions">Posts <i class=" fa fa-caret-down" style="font-size:24px" title="Post Option"></i></button>
          <div id="tab-dropdown2">
            <div class="tab-dropdown">
              <button class="tablinks-dropdown articletab-button" onclick="opendropdown(event, 'articletab')" id="defaultOpen">Article</button>
              <button class="tablinks-dropdown" onclick="opendropdown(event, 'abouttab')" >About</button>
              <button class="tablinks-dropdown" onclick="opendropdown(event, 'pstab')">Public Servants</button>
            </div> 
          </div>
      
    </div>  

</div>

<div id="main" style="margin-left: 200px;"> 


    <div class="row">
      <div class="col-12 col-md-1" ></div>
      <div class="col-12 col-md-10">
          <div id="articletab" class="tabcontent post_tab">
            <iframe src='articletab.php' id ='articleframe' scrolling='no'></iframe>
          </div>
          <div id="abouttab" class="tabcontent abouttab">
            <iframe src='about-settings.php' id ='aboutframe' scrolling='no'></iframe>
          </div>
          <div id="pstab" class="tabcontent pstab">
            <iframe src='public-servants.php' id ='psframe' scrolling='no'></iframe>
          </div>
      </div>
      <div class="col-12 col-md-1"></div>
    </div> <!-- End row -->

</div><!-- End Main -->

<!--- Start Footer Section -->
<?php  
include("footer.php");
?>
<!-- End Footer Section -->    