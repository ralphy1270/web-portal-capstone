<?php  
include("includes/header.php");
if(isset($_GET['article_id'])){
	$article_id = $_GET['article_id'];
}

if($article_id == ""){
	header("Location: index.php");
	exit();
}
else{
	$query = mysqli_query($con, "SELECT * FROM posts WHERE archived ='no' AND id ='$article_id'");
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		$category = $row['category'];
		$title = $row['title'];
		$date = $row['date_added'];
		$post_pic = $row['post_pic'];
		$content = $row['content'];
		$description = $row['description'];
	}
	else {
		header("Location: index.php");
		exit();
	}
	
}
?>

<head>
	<title>Sta. Cruz, Laguna - Youth and Sports Develpment - <?php echo $title; ?></title>
</head>

<div class="cover">
	<div class="light-cover-article" style="text-transform: capitalize;"><p class="os-animation" data-animation="fadeInLeft">Youth and Sports Development</p></div>
</div>


<div class="col-12 content">
	<div class="row content-row justify-content-md-center">
		<div class="col-12 col-md-9 content-info">
			
			<div class="updates-body">

				<div class="program-update-article">
					<div class="program-article-title"><?php echo $title; ?></div>
					<div class="program-article-date-category">
						<div class="program-article-date-div"><span>Date:</span><br><?php echo $date; ?></div>	
						<div class="program-article-category-div"><span>Category:</span><br><?php echo $category; ?></div>		
					</div>
					<div class="program-article-wall">
						<img src="admin/<?php echo $post_pic; ?>">			
					</div>
					<div class="program-article-description">
						<?php echo $description; ?>
					</div>
					<div class="program-article-content">
						<?php echo $content; ?>
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
