<?php  
include("includes/header.php");
$user_data_query = mysqli_query($con, "SELECT * FROM about");
$row = mysqli_fetch_array($user_data_query);
	$Additional =$row['additional'];
	if($Additional != ""){
		$Additional = $row['additional'];
	}
	else {
		$Additional = "";
	}
?>
<head>
	<title>About Us - Sta. Cruz, Laguna - Youth and Sports Develpment</title>
	<style type="text/css">
		a.aboutpage {
			color: rgba(255, 211, 42,1.0);
		}
	</style>
</head>


<div class="cover">
	<div class="light-cover"><p class="os-animation" data-animation="fadeInLeft">About Us</p></div>
</div>

<!-- Content -->
<div class="col-12 content">
	<div class="row content-row justify-content-md-center">
		<div class="col-12 col-md-9 content-info">
			<div style="margin: 0 59px 0 63px; text-indent: 38px;">
				<?php echo $Additional; ?>
			</div>
			<div class="information-content">	
				<h2>General Information</h2>
				<hr>
				<p><?php echo $get_obj->general_info(); ?></p>
			</div>
			<div class="information-content">	
				<h2>Mission</h2>
				<hr>
				<p><?php echo $get_obj->mission(); ?></p>
			</div>
			<div class="information-content">	
				<h2>Vision</h2>
				<hr>
				<p><p><?php echo $get_obj->vission(); ?></p></p>
			</div>
			<div class="information-content">	
				<h2>Contact Us!</h2>
				<hr>
				<h6>Address:</h6>
				<p><p style="text-align: center; text-indent: 0;"><?php echo $get_obj->address(); ?></p>
				</p>				
				<h6>Tel No:</h6>
				<p style="text-align: center; text-indent: 0;"><?php echo $get_obj->contact(); ?></p>
				<h6>Email:</h6>
				<p style="text-align: center; text-indent: 0;"><?php echo $get_obj->email(); ?></p>
			</div>
		</div>
		<div class="col-12 col-md-3 content-side">
			<div class="content-background">
				<div class="sideinfo-content">
					<h5>Latest Post</h5>
				</div>
				<div class="content-side-article">
					<?php
					  echo $user_obj->loadPostPrograms_Services();
			   		?>
		   		</div>
		   		<div class="sideinfo-content">
					<h5>Categories</h5>
				</div>
				<div class="content-side-categories">
					<a href="category.php?category=Health">Health</a>
					<a href="category.php?category=Education">Education</a>
					<a href="category.php?category=Sports">Sports</a>
					<a href="category.php?category=Environment">Environment</a>
					<a href="category.php?category=Contigency">Contigency</a>
					<a href="category.php?category=Legislation">Legislation</a>
		   		</div>
	   		</div>
		</div>
	</div>
</div>

<?php  
include("footer.php");
?>