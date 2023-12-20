<?php  
include("includes/header.php");
?>

<head>
	<title>Services - Sta. Cruz, Laguna - Youth and Sports Develpment</title>
</head>

<div class="cover">
	<div class="light-cover"><p class="os-animation" data-animation="fadeInLeft">Services</p></div>
</div>


<div class="col-12 content">
	<div class="row content-row justify-content-md-center">
		<div class="col-12 col-md-9 content-info">
			<div style="width: 100%; height: auto;"><?php echo $get_obj->Additional_Services();?></div>
			<div class="row programs-category-row">
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'health');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Health</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Health&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'education');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Education</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Education&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'sports');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Sports</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Sports&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'environment');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Environment</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Environment&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'contigency');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Contigency</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Contigency&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="programs-category-column">
					    <div class="programs-category-card">
					      <div class="programs-category-picture">
					      	<img src="<?php echo $user_obj->getpost_row('service', 'legislation');?>">
					      </div>
					      <div class="programs-category-title">
					      	<p>Legislation</p>
					      </div>
					      <div class="button"><a href="categories.php?category=Legislation&post_type=Service"><button type="button" class="btn">More Information</button></a></div>
					    </div>
					</div>
				</div>
			</div>
			<div class="updates-body">
				<div class="col-md-12 label-latest-events-div">
					<div class='label-latest-events'> Services Updates</div>
				</div>

				<div class="program-update-article">
					<div class="posts_area"></div>
					<div style="text-align: center;">
						<button id="button" type="button" class="btn" style="background-color: rgba(189, 195, 199,0.3); padding: 0.6rem 2rem 0.6rem 2rem;">Load More Post</button>
						<br>
						<img id="loading" src="assets/images/icons/loading.gif">
					</div>
		   		</div>
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
					<h5>Latest Events</h5>
				</div>
				<div class="content-side-article">
					<?php
					  echo $user_obj->loadPostPrograms_Latest_Events();
			   		?>
		   		</div>
	   		</div>
		</div>
	</div>
</div>



<?php  
include("footer.php");
?>

<script>

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_services.php",
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
				if (noMorePosts == 'false') {
					$('#loading').show();

					var ajaxReq = $.ajax({
						url: "includes/handlers/ajax_load_services.php",
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