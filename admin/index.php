<?php 
include("includes/header.php");

if($user['user_type'] == "admin"){

  header("Location: index-admin.php");
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
      <button class="tablinks no-dropdown" onclick="openCity(event, 'userstab')" id="defaultOpen">Users</button>
      <button class="tablinks" id="postoptions">Posts <i class=" fa fa-caret-down" style="font-size:24px" title="Post Option"></i></button>
          <div id="tab-dropdown">
            <div class="tab-dropdown">
              <button class="tablinks-dropdown articletab-button" onclick="opendropdown(event, 'articletab')" id="defaultOpen">Article</button>
              <button class="tablinks-dropdown" onclick="opendropdown(event, 'abouttab')" >About</button>
              <button class="tablinks-dropdown" onclick="opendropdown(event, 'pstab')">Public Servants</button>
            </div> 
          </div>
      <button class="tablinks no-dropdown" onclick="openCity(event, 'messagestab')">Messages</button>
 <!--     <button class="tablinks no-dropdown" onclick="openCity(event, 'recordstab')">Records</button>-->
      <button class="tablinks no-dropdown" onclick="openCity(event, 'forumtab')">Forum</button>
    </div>  

</div>

<div id="main" style="margin-left: 200px;"> 


    <div class="row">
      <!--<div class="col-12 col-md-1" ></div> -->
      <div class="col-12 col-md-12">
          <div id="articletab" class="tabcontent post_tab">
            <iframe src='articletab.php' id ='articleframe' scrolling='no'></iframe>
          </div>
          <div id="abouttab" class="tabcontent abouttab">
            <iframe src='about-settings.php' id ='aboutframe' scrolling='no'></iframe>
          </div>
          <div id="pstab" class="tabcontent pstab">
            <iframe src='public-servants.php' id ='psframe' scrolling='no'></iframe>
          </div>
         <!--<div id="recordstab" class="tabcontent">
            <h3>London</h3>
            <p>London is the capital city of England.</p>
            
            <button onclick="openCity(event, 'messagestab')">gy</button>
          </div>-->
          <div id="forumtab" class="tabcontent">
            <iframe src="forum.php" scrolling="yes" id="forum_admin"></iframe>
          </div>
          <div id="userstab" class="tabcontent">
            <span style=" font-size: 3rem;"></span>
              <div  id="main_div" style="margin-top: 1.5rem;">  
                <ul class="nav nav-tabs" role="tablist" id="profileTabs">
                    <li role="presentation" class="active"><a href="#sadmins" aria-controls="sadmins" role="tab" data-toggle="tab" onClick='document.getElementById("table-sadmin").src="table-sadmin.php";'>Super Admin</a></li>
                    <li role="presentation"><a href="#admins" aria-controls="admins" role="tab" data-toggle="tab" onClick='document.getElementById("table-admin").src="table-admin.php";'>Admin</a></li>
                    <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab" onClick='document.getElementById("table-user").src="table-user.php";'>User</a></li>
                    <li role="presentation"><a href="#archived" aria-controls="archived" role="tab" data-toggle="tab" onClick='document.getElementById("table-archive").src="table-archive.php";'>Archived</a></li>
                </ul>
                  <br>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane table-tab active" id="sadmins">
                    <iframe src='table-sadmin.php' id ='table-sadmin' scrolling='no'></iframe>
                  </div>
                  <div role="tabpanel" class="tab-pane table-tab" id="admins">
                    <iframe src='table-admin.php' id ='table-admin' scrolling='no'></iframe>
                  </div>
                  <div role="tabpanel" class="tab-pane table-tab table-section" id="users">
                    <iframe src='table-user.php' id ='table-user' scrolling='no'></iframe>
                  </div>
                  <div role="tabpanel" class="tab-pane table-tab table-section" id="archived">
                    <iframe src='table-archive.php' id ='table-archive' scrolling='no'></iframe>
                  </div>
                </div><!-- end tab-content -->
              </div><!-- end main_div -->
          </div>  
          <div id="poststabarticle" class="tabcontent">
            <h3>Washington</h3>
            <p>Washington is the capital of USA.</p>
          </div>
          <div id="messagestab" class="tabcontent">
            <iframe src="messages.php?u=new" id="message_iframe" scrolling="yes"></iframe>
          </div>
      </div>
      <!--<div class="col-12 col-md-1"></div> -->
    </div> <!-- End row -->

</div><!-- End Main -->

<!--- Start Footer Section -->
<?php  
include("footer.php");
?>
<!-- End Footer Section -->    
