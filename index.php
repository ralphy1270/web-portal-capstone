<?php  
include("includes/header.php");
$date = date("Y-m-d");
/*$query = mysqli_query($con, "INSERT INTO posts VALUES('', 'Eliza Lo', 'Test', 'Test', '2021-23-07', 'Contigency', 'Event', 'no', 'no', 'no', 'assets/images/posts/603b6b36ca3c6148181354_480194776705257_765142342107878674_n.jpg', 'blessyrose')"); */
if(isset($_GET['downloadable_file'])){
	$name = $_GET['downloadable_file'];
	header("Content-Disposition: attachment; filename=" .$name);
	header("Content-Type: application/octet-stream;");
	readfile("uploads/" .$name);
	$con = null;
}
?>
<head>
	<title>Sta. Cruz, Laguna - Youth and Sports Develpment</title>
	<style type="text/css">
		a.homepage {
			color: rgba(255, 211, 42,1.0);
		}
	</style>
</head>	
<!--- Intro Section -->
<div id="intro">		
<!--- Start Carousel Image Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="7000">
	
	<div class="carousel-inner" role="listbox">
<!-- Slide One -->
		<div class="carousel-item active" style="background-image: url('admin/assets/images/backgrounds/cover.png')" alt="">
			<div class="carousel-caption text-center">
				<div class="os-animation" data-animation="fadeInUp" data-delay="1.2s">
					<h1>Youth and Sports Development</h1>
					<h3>Sta. Cruz, Laguna</h3>
				</div>				
				<div class="os-animation background-filter-caption" data-animation="fadeInUp" data-delay="0.6s">
					<div class="background-filter-caption-title">
						<a href="article.php?article_id=<?php $user_obj->Get_Latest_Link(); ?>">
						<p class="background-filter-title text-left" style="margin: 0.9rem 1.4rem;"></p>
						</a>
					</div>
				</div>
			</div> <!--- End Carousel Caption -->
			<div class="os-animation background-filter-left" data-animation="fadeInLeft" data-delay="1s">
				<img src="assets/images/backgrounds/Dunk-it-jonathan.png">
			</div>
			<div class="os-animation background-filter-right" data-animation="fadeInRight" data-delay="1s">
				<img src="assets/images/backgrounds/Volleyball.png">
			</div>
			<div class="background-main-filter">
			</div>
		</div>
<!-- Slide Two -->
		<div class="carousel-item" style="background-image: url('<?php $user_obj->Get_Program_post_pic(); ?>')" alt="">
			<div class="os-animation background-filter-caption-2" data-animation="fadeInUp" data-delay="1s">
				<p class="background-filter-title"></p>
			</div>
			<div class="background-filter">
			</div>
		</div>
<!-- Slide Three -->
		<div class="carousel-item" style="background-image: url('<?php $user_obj->Get_Event_post_pic(); ?>')" alt="">
			<div class="os-animation background-filter-caption-2" data-animation="fadeInUp" data-delay=".8s">
				<p class="background-filter-title"></p>
			</div>
			<div class="background-filter">
			</div>	
		</div>
	</div> <!--- End Carousel Inner -->
<!--- Previous & Next Buttons -->
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
<!--- Bouncing Down Arrow -->
	<a class="down-arrow" href="#services-section">
		<div class="arrow bounce d-none d-md-block">
			<i class="fas fa-angle-down" aria-hidden="true"></i>
		</div>
	</a><!--- End of Bouncing Down Arrow -->
</div>

<!-- Start of Link-Tab Section -->
<div class="link-section offset">
	<div class="link-group">
		<div class="row">
			<div class="link col-sm-12 col-md-4">
				<div class="link-icon">
					<i class="fa fa-download" aria-hidden="true"></i>
				</div>
				<div class="link-text"><a href="downloadable-files.php">Downloadable Forms</a></div>
			</div>	
			<div class="link col-sm-12 col-md-4">
				<div class="link-icon">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
				</div>
				<div class="link-text"><a href="services.php">Guide to Services</a></div>
			</div>	
			<div class="link col-sm-12 col-md-4">
				<div class="link-icon">
					<i class="fa fa-envelope" aria-hidden="true"></i>
				</div>
				<div class="link-text"><a href="javascript:void(0);" onclick="getDropdownDataRequest('<?php echo $loggedin_user; ?>', 'submitforms')" data-toggle="modal" <?php if(isset($_SESSION['username_applicant'])){ }else{echo "data-target='#request_modal'";} ?>>Submit Forms/Letters</a></div>
			</div>	
		</div>	
	</div>
</div><!-- End of Link-Tab Funtion -->

<!-- Start Services Section -->
<div id="services-section" class="services-section">
	<div class="row services-section-content">
		<div class="col-md-12 col-lg-4 updates-section">
			<div class="label-update">Updates</div>
			<div class="updates-article">
				<div id="updates-slider" class="owl-carousel owl-theme updates-slider">
<!-- Start Updates Slider -->
				<?php
					echo $user_obj->loadPostUpdates();
				?>
<!-- End Updates Slider -->
				</div>	
				<div class="more">
	   				<a href="category.php?category=Latest Updates">More Updates</a>
	   			</div>
			</div>	
		</div>
		<div class="col-md-12 col-lg-4 announcement-section">
			<div class='label-announcement'>Announcement</div>
				<?php
					echo $user_obj->loadAnnouncement();
		   		?>
		</div>
		<div class="col-md-12 col-lg-4 tab-section">
			<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'Upcoming Events')" id="defaultOpen">Upcoming Events</button>
			  <button class="tablinks" onclick="openCity(event, 'Downloadable Files')">New Files Released</button>
			</div>
			<div id="Upcoming Events" class="tabcontent">
			    <?php
			  	  echo $user_obj->loadTabEvents();
	   		    ?>  
	   		<div class="more">
	   			<a href="events.php">More Events</a>
	   		</div>
			</div>
			<div id="Downloadable Files" class="tabcontent">
				<div class='row'>
				<?php
			  	  echo $user_obj->downloadableTab();
	   		    ?>  
	   			</div>
	   		<!--	<div class="more">
	   				<a href="downloadable-files.php">More Files</a>
	   			</div> -->
			</div>
		</div>
	</div>
</div><!-- End of Link-Tab Section -->

<!--- Start public-servants-section Section -->
<div id="latest-events" class="latest-events-section offset">

<!--- Start Fixed Background IMG Light -->
<div class="fixed-background">

<div class="row light">
	<div class="col-md-12 label-latest-events-div">
		<div class='label-latest-events'>Latest Events</div>
	</div>

	<div class="col-md-12">
		<div id="latest-events-slider" class="owl-carousel owl-theme latest-events-slider">

			<?php
			  	  echo $user_obj->loadLatestEvents();
	   		?>

		</div> <!--- End Lates Event Slider -->
	</div> <!--- End col-md-12 -->

</div> <!--- End of Row Light -->

	<div class="fixed-wrap">
		<div id="fixed-2">
		</div>
	</div>

</div>
<!--- End Fixed Background IMG Light -->

</div>
<!--- End public-servants-section Section -->

<!--- Start Category Section -->
<div class="category-section">
	<div class="label-category-div">
		<div class="label-category">Programs and Services</div>
	</div>
	<div class="category-div">
		<div class="row">
			<div class="col-0 col-md-2"></div>
			<div class="col-12 col-md-8">
				<div class="row no-padding">
					
					<div class="col-6 col-md-4">
						<a href="category.php?category=Health">
						<div class="category-container">
						<div class="category-item">
								<?php echo $user_obj->Category(1);?>
						</div>
						<div class="overlay">
   							 <div class="text">Health</div>
  						</div>
  						<div class="overlay-background">
   					    	<!-- DARK THEME -->
  						</div>
						</div>
						</a>
					</div>
					<div class="col-6 col-md-4">
						<a href="category.php?category=Education">
						<div class="category-container">
						<div class="category-item">
								<?php echo $user_obj->Category(2);?>
						</div>
						<div class="overlay">
   							 <div class="text">Education</div>
  						</div>
  						<div class="overlay-background">
   					    	<!-- DARK THEME -->
  						</div>
						</div>
						</a>
					</div>
					<div class="col-6 col-md-4">
						<a href="category.php?category=Sports">
						<div class="category-container">
						<div class="category-item">
								<?php echo $user_obj->Category(3);?>
								<div class="overlay">
   							 		<div class="text">Sports</div>
  								</div>
  								<div class="overlay-background">
   					    			<!-- DARK THEME -->
  								</div>
						</div>
						</div>
						</a>
					</div>
					<div class="col-6 col-md-4">
						<a href="category.php?category=Environment">
						<div class="category-container">
						<div class="category-item">
								<?php echo $user_obj->Category(4);?>
							
						</div>
						<div class="overlay">
   							 <div class="text">Environment</div>
  						</div>
  						<div class="overlay-background">
   					    	<!-- DARK THEME -->
  						</div>
						</div>
						</a>
					</div>
					<div class="col-6 col-md-4">
						<a href="category.php?category=Contigency">
						<div class="category-container">
						<div class="category-item">
								<?php echo $user_obj->Category(5);?>
						</div>
						<div class="overlay">
   							 <div class="text">Contigency</div>
  						</div>
  						<div class="overlay-background">
   					    	<!-- DARK THEME -->
  						</div>
						</div>
						</a>
					</div>
					<div class="col-6 col-md-4">
						<a href="category.php?category=Legislation">
						<div class="category-container">
						<div class="category-item">
							
								<?php echo $user_obj->Category(6);?>
						</div>
						<div class="overlay">
   							 <div class="text">Legislation</div>
  						</div>
  						<div class="overlay-background">
   					    	<!-- DARK THEME -->
  						</div>
						</div>
						</a>
					</div>
				</div>
				<br><br><br><br>
				<div class="posts_area"></div>
				<br><br>
				<div style="text-align: center;">
					<button id="button" type="button" class="btn button-load">Load More Post</button>
					<br>
					<img id="loading" src="assets/images/icons/loading.gif">
				</div>

			</div>	
			<div class="col-0 col-md-2"></div>
		</div>
	</div>	

</div><!--- End Category Section -->

<!--- Start Public-Servants-Section  -->
<div id="public-servants-section" class="public-servants-section offset">

<!--- Start Fixed Background IMG Light -->
<div class="fixed-background">

<div class="row light-3">

	<div class="col-12 label-public-servants">
		<h3 class="label-public-servants-text">Public Servants</h3>
	</div>

	<div class="col-md-12">
		<div class="container">
		<div id="public-servants-section-slider" class="owl-carousel owl-theme public-servants-section-slider">
			<?php
			  	echo $user_obj->loadPublicServants();
	   		?>
		</div> <!--- End public-servants-section Slider -->
		</div>
	</div> <!--- End col-md-12 -->

</div> <!--- End of Row Light -->

	<div class="fixed-wrap">
		<div id="fixed-3">
		</div>
	</div>

</div>
<!--- End Fixed Background IMG Light -->

</div>
<!--- End Public-Servants Section -->

<!--- Start Footer Section -->

<?php  
include("footer.php");
?>
<!-- End Footer Section -->

<script>

	$(document).ready(function() {

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_index_category.php",
			type: "POST",
			data: "page=1",
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
		//$('#load_more').on("click", function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			 document.getElementById('button').onclick = function() {
			//if (noMorePosts == 'false') {
				if (noMorePosts == 'true') {
					$('#button').hide();
				}
				if (noMorePosts == 'false') {
					$('#loading').show();

					var ajaxReq = $.ajax({
						url: "includes/handlers/ajax_index_category.php",
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
				}
			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>

	