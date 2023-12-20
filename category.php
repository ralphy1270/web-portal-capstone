<?php  
include("includes/header.php");
if(isset($_GET['category'])){
	$category = $_GET['category'];
}
if(isset($_GET['post_type'])){
	$post_type = $_GET['post_type'];
}	
else{
	$post_type = "";
}	

if($category == ""){
	header("Location: index.php");
	exit();
}
else{
	
}
?>

<head>
	<title><?php echo $category; ?> - Sta. Cruz, Laguna - Youth and Sports Develpment</title>
</head>

<div class="cover">
	<div class="light-cover" style="text-transform: capitalize;"><p class="os-animation" data-animation="fadeInLeft"><?php echo $category; ?></p></div>
</div>


<div class="col-12 content">
	<div class="row content-row justify-content-md-center">
		<div class="col-12 col-md-9 content-info">
			
			<div class="updates-body">

				<div class="program-update-article">
					<div class="posts_area"></div>
					<br><br>
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
					<h5>Upcoming Events</h5>
				</div>
				<div class="content-side-article">
					<?php
					  echo $user_obj->loadPostPrograms_Latest_Events();
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

<script>

	$(document).ready(function() {
		var category = '<?php echo $category; ?>';
		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_category.php",
			type: "POST",
			data: "page=1&category=" + category,
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
						url: "includes/handlers/ajax_load_category.php",
						type: "POST",
						data: "page=" + page + "&category=" + category,
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