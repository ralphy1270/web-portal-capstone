<?php
class Post {
	private $user_obj;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$this->user_obj = new User($con);
	}
	public function Get_Event_post_pic(){
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type ='event' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			$post_pic = "admin/" .$row['post_pic'];
		}
		else{
			$post_pic = "assets/images/post_pics/MYSDO LOGO.png";
		}
		echo $post_pic;
	}
	public function Get_Program_post_pic(){
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type ='program' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			$post_pic = "admin/" .$row['post_pic'];
		}
		else{
			$post_pic = "assets/images/post_pics/MYSDO LOGO.png";
		}
		echo $post_pic;
	}
	public function Get_Latest_Post(){
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND (post_type='service' OR post_type ='program') ORDER BY id DESC LIMIT 1");
		$row = mysqli_fetch_array($query);
		$title = $row['title'];
		echo $title;
	}
	public function Get_Latest_Link(){
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND (post_type='service' OR post_type ='program') ORDER BY id DESC LIMIT 1");
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		echo $id;
	}
	public function loadPostUpdates(){
		$count = 1;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' ORDER BY id DESC LIMIT 8");
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				if($count == 1){
					$str .= "<div class='updates-card'>";
				}
				if($count == 5){
					$str .= "</div>
					<div class='updates-card'>";
				}
				$id = $row['id'];
				$category = $row['category'];
				$title = $row['title'];
				$date = $row['date_added'];
				$post_pic = $row['post_pic'];
				$str .= "<div  class='updates-article-section'>
								<div class='updates-picture'>
									<a href='article.php?article_id=" .$id. " '>
										<img src='admin/$post_pic'>
									</a>	
								</div>
								<div class='update-title-column'>
									<div class='updates-title'>
										<a href='article.php?article_id=" .$id. " '>"
										.$title. "
										</a>
									</div>
									<div class='date-category-column'>
										<div class='updates-category'>
											<a href='category.php?category=" .$category. "'>"
											.$category.
											"</a>
										</div>
										<div class='updates-date'>
											<i class='far fa-calendar-alt'></i>" .$date."
										</div>
									</div>
								</div>
						 </div>";			
				
				$count++;					
			}
			$str .= "</div>";
		}
		else {
			$str .= "<div  class='updates-article-section'>
								<div class='updates-picture'>
									<a href='#'>
										<img src='assets/images/post_pics/MYSDO LOGO.png'>
									</a>	
								</div>
								<div class='update-title-column'>
									<div class='updates-title'>
										<a href='#'>No Post Yet
										</a>
									</div>
									<div class='date-category-column'>
										<div class='updates-category'>
											<a href='#'>No Post Yet</a>
										</div>
										<div class='updates-date'>
											<i class='far fa-calendar-alt'></i>No Post Yet
										</div>
									</div>
								</div>
						 </div>";
		}
		echo $str;
	}

	public function loadAnnouncement(){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'Announcement' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			$id = $row['id'];
			$title = $row['title'];
			$date = $row['date_added'];
			$post_pic = $row['post_pic'];

			$str .= "<div class='announcement-content'>
						<div class='announcement-picture'>
							<a href='article.php?article_id=" .$id. " '>
								<img src='admin/$post_pic'>
							</a>
						</div>
						<div class='announcement-title'>
							<a href='article.php?article_id=" .$id. " '>" .$title. "</a>
						</div>
						<div class='updates-date'>
							<i class='far fa-calendar-alt'></i>" .$date. "
						</div>
				    </div>";
		}	    
		else {
			$str .= "<div class='announcement-content'>
						<div class='announcement-picture'>
							<a href='#'>
								<img src='assets/images/post_pics/MYSDO LOGO.png'>
							</a>
						</div>
						<div class='announcement-title'>
							<a href='#'>No Post Yet</a>
						</div>
						<div class='updates-date'>
							<i class='far fa-calendar-alt'></i>No Post Yet
						</div>
				    </div>";
		}
		echo $str;	
	}
	public function loadTabEvents(){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'event' ORDER BY id DESC LIMIT 4");
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$title = $row['title'];
			$date = $row['date_added'];
			$post_pic = $row['post_pic'];

			$opening_date = new DateTime($date);
			$current_date = new DateTime();

			if ($opening_date > $current_date)
			{
			  $str .= "<div class='events-section'>
					  	<div class='events-picture'>
					  		<a href='article.php?article_id=" .$id. " '>
					  			<img src='assets/images/icons/logo.png'>
					  		</a>	
					  	</div>
					  	<div class='events-title-date'>
					  		<div class='updates-date'>
					  			<i class='far fa-calendar-alt'></i>" .$date. "
					  		</div>
					  		<div class='events-title'>
					  			<a href='article.php?article_id=" .$id. " '>".$title. "</a>
					  		</div>
					  	</div>	
			         </div>";
			}
			
		}
		echo $str;
	}	
	public function loadLatestEvents(){
		$count = 0;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'event' ORDER BY id DESC LIMIT 6");
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				$count++;
				$id = $row['id'];
				$title = $row['title'];
				$date = $row['date_added'];
				$post_pic = $row['post_pic'];
				if($count == 1){
					$str .= "<div class='latest-events-row'>
							<div class='latest-events-div-body'>";
				}
				if($count == 4){
					$str .= "</div></div>
					<div class='latest-events-row'>
							<div class='latest-events-div-body'>";
				}	
				$str .="		<div class='latest-event-info'>
									<div class='latest-event-picture'>
										<a href='article.php?article_id=" .$id. " '>
											<img src='admin/$post_pic'>
										</a>	
									</div>
									<div class='latest-event-title'>
										<a href='article.php?article_id=" .$id. " '>".$title. "</a>
									</div>
									<div class='latest-event-date'>
										<i class='far fa-calendar-alt'></i>" .$date. "
									</div>
								</div>";


			}
			$str .= "</div></div>";
		}
		else {
			$str .="";
		}	
		echo $str;
	}

	public function downloadableTab(){
	$count = 0;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC LIMIT 9");
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				$count++;
				$id = $row['id'];
				$downloadName = $row['file_name'];
				$title = $row['filename_download'];
				if($downloadName != ""){
					$str .="<div class='col-md-12 Downloadable-tab' style='padding: 9px 0 9px 0; '><a href='index.php?downloadable_file=$downloadName'><i class='fa fa-download' aria-hidden='true'style='margin-right: 1rem;''></i>$title</a>
							</div>";
				}
				else{
					continue;
				}
				
			}
		}
		else {
			$str .="";
		}	
		echo $str;
	}
	public function Category($category){
		if($category == 1){
			$sub ="health";
		}
		if($category == 2){
			$sub ="education";
		}
		if($category == 3){
			$sub ="sports";
		}
		if($category == 4){
			$sub ="environment";
		}
		if($category == 5){
			$sub ="contigency";
		}
		if($category == 6){
			$sub ="legislation";
		}
		$query = mysqli_query($this->con, "SELECT post_pic FROM posts WHERE archived ='no' AND category ='$sub' ORDER BY id DESC LIMIT 1");
		$num = mysqli_num_rows($query);
		if($num == 0){
			$wallpaper = "<img class='example-image' src='assets/images/post_pics/MYSDO LOGO.png' alt=''>";
		}else {
			$row = mysqli_fetch_array($query);
			$post_pic = $row['post_pic'];
			$wallpaper = "<img src='admin/$post_pic' alt=''>";
		}
		echo $wallpaper;
	}
	public function loadPublicServants(){
		$count = 0;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM public_servants");
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				$count++;
				$id = $row['id'];
				$name = $row['name'];
				$position = $row['position'];
				$profile_pic = $row['profile_pic'];
				if($count == 1){
					$str .= "<div class='public-servants-div'>
							 <div class='public-servants-center'>";
				}
				if($count == 6){
					$str .= "</div></div>
					<div class='public-servants-div'>
							<div class='public-servants-center'>";
				}	
				$str .="<div class='card text-center'>	
							<div class='card-img-div'>
								<img src='admin/$profile_pic' alt='" .$profile_pic. "'>
							</div>
							<div class='card-body'>
								<h4>" .$name. "</h4>
								<h5>" .$position. "</h5>
							</div>		
						</div>";
			}
			$str .= "</div></div>";
		}
		else {
			$str .= "<p class='no-post'>No Post</p>";
		}
		echo $str;
	}

	public function loadPostPrograms_Services(){
		$count = 1;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' ORDER BY id DESC LIMIT 4");
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$category = $row['category'];
				$title = $row['title'];
				$date = $row['date_added'];
				$post_pic = $row['post_pic'];
				$str .= "<div class='side-tab-post'>
							<div class='row'>
								<div class='col-md-5 side-tab-post-pic'>
									<a href='category.php?category=$category'><img src='admin/$post_pic'></a>
								</div>
								<div class='col-md-7 side-tab-post-info'>
									<div class='side-tab-post-title'><a href='article.php?article_id=$id'>$title</a></div>
									<div class='side-tab-post-category'><a href='category.php?category=$category'>$category</a></div>
									<div class='side-tab-post-date'><i class='far fa-calendar-alt'></i>$date</div>
								</div>
							</div>
						 </div>";								
			}
		}
		else {
			$str.= "";
		}
		echo $str;
	}

	public function loadPostPrograms_Latest_Events(){
		$count = 1;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'event' ORDER BY id DESC LIMIT 4");
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$category = $row['category'];
			$title = $row['title'];
			$date = $row['date_added'];
			$post_pic = $row['post_pic'];
			$str .= "<div class='side-tab-post'>
							<div class='row'>
								<div class='col-md-5 side-tab-post-pic'>
									<a href='category.php?category=$category'><img src='admin/$post_pic'></a>
								</div>
								<div class='col-md-7 side-tab-post-info'>
									<div class='side-tab-post-title'><a href='article.php?article_id=$id'>$title</a></div>
									<div class='side-tab-post-category'><a href='category.php?category=$category'>$category</a></div>
									<div class='side-tab-post-date'><i class='far fa-calendar-alt'></i>$date</div>
								</div>
							</div>
						 </div>";								
		}
		echo $str;
	}


	public function getpost_row($post_type, $category){
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = '$post_type' AND category='$category' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			$post_pic = $row['post_pic'];
			$getter = "admin/$post_pic";
		}
		else {
			$getter = "assets/images/post_pics/MYSDO LOGO.png";
		}
		return $getter;
	}	
	public function Updates_Programs($data, $limit){

		$page = $data['page'];

		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;

		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'program' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {

			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$category = $row['category'];
				$title = $row['title'];
				$date = $row['date_added'];
				$post_pic = $row['post_pic'];


				if($num_iterations++ < $start)
						continue; 


					//Once 10 posts have been loaded, break
					if($count > $limit) {
						break;
					}
					else {
						$count++;
					}

				$str .= "<div class='program-update-article'>
							<div class='updates-body-card'>
								<div class='row'>
									<div class='update-card-pic-sec col-md-4 col-sm-12'>
										<div class='updates-body-pic'>
											<a href='article.php?article_id=" .$id. " '>
												<img src='admin/$post_pic'>
											</a>	
										</div>
									</div>
										<div class='col-md-8 col-sm-12'>
										<div class='updates-body-title'>
											<a href='article.php?article_id=" .$id. " '>
											" .$title. "
											</a>
										</div>
										<div class='title-date-update-program'>
											<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
											<div class='updates-body-category'>
												<a href='category.php?category=" .$category. "'>
												" .$category. "
												</a>
											</div>
									    </div>
									</div>	
								</div>
							</div>
			   			</div>";		
			}
			if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
				else 
					$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
		else {
			$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
		echo $str;
	}
	public function Updates_Events($data, $limit){

		$page = $data['page'];

		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;

		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'event' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {

			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$category = $row['category'];
				$title = $row['title'];
				$date = $row['date_added'];
				$post_pic = $row['post_pic'];


				if($num_iterations++ < $start)
						continue; 


					//Once 10 posts have been loaded, break
					if($count > $limit) {
						break;
					}
					else {
						$count++;
					}

				$str .= "<div class='program-update-article'>
							<div class='updates-body-card'>
								<div class='row'>
									<div class='update-card-pic-sec col-md-4 col-sm-12'>
										<div class='updates-body-pic'>
											<a href='article.php?article_id=" .$id. " '>
												<img src='admin/$post_pic'>
											</a>	
										</div>
									</div>
										<div class='col-md-8 col-sm-12'>
										<div class='updates-body-title'>
											<a href='article.php?article_id=" .$id. " '>
											" .$title. "
											</a>
										</div>
										<div class='title-date-update-program'>
											<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
											<div class='updates-body-category'>
												<a href='category.php?category=" .$category. "'>
												" .$category. "
												</a>
											</div>
									    </div>
									</div>	
								</div>
							</div>
			   			</div>";		
			}
			if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
				else 
					$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}	
		else {
			$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
		echo $str;
	}
	public function Updates_Services($data, $limit){

			$page = $data['page'];

			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;

			$str = "";
			$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND post_type = 'service' ORDER BY id DESC");
			if(mysqli_num_rows($query) > 0) {

				$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;

				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$category = $row['category'];
					$title = $row['title'];
					$date = $row['date_added'];
					$post_pic = $row['post_pic'];


					if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

					$str .= "<div class='program-update-article'>
								<div class='updates-body-card'>
									<div class='row'>
										<div class='update-card-pic-sec col-md-4 col-sm-12'>
											<div class='updates-body-pic'>
												<a href='article.php?article_id=" .$id. " '>
													<img src='admin/$post_pic'>
												</a>	
											</div>
										</div>
											<div class='col-md-8 col-sm-12'>
											<div class='updates-body-title'>
											<a href='article.php?article_id=" .$id. " '>
											" .$title. "
											</a>
											</div>
											<div class='title-date-update-program'>
												<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
												<div class='updates-body-category'>
												<a href='category.php?category=" .$category. "'>
												" .$category. "
												</a>
												</div>
										    </div>
										</div>	
									</div>
								</div>
				   			</div>";		
				}
				if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
			}
			else {
			$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
			echo $str;
	}

	public function Updates_Category($data, $limit){
			$category = $data['category'];
			$page = $data['page'];

			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;

			$str = "";
			if($category == "Latest Updates") {
				$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' ORDER BY id DESC");
			}
			else {
				$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND category = '$category' ORDER BY id DESC");
			}
			
			if(mysqli_num_rows($query) > 0) {

				$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;

				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$category = $row['category'];
					$title = $row['title'];
					$date = $row['date_added'];
					$post_pic = $row['post_pic'];


					if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

					$str .= "<div class='program-update-article'>
								<div class='updates-body-card'>
									<div class='row'>
										<div class='update-card-pic-sec col-md-4 col-sm-12'>
											<div class='updates-body-pic'>
												<a href='article.php?article_id=" .$id. " '>
													<img src='admin/$post_pic'>
												</a>	
											</div>
										</div>
											<div class='col-md-8 col-sm-12'>
											<div class='updates-body-title'>
											<a href='article.php?article_id=" .$id. " '>
											" .$title. "
											</a>
											</div>
											<div class='title-date-update-program'>
												<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
												<div class='updates-body-category'>
													<a class='hover-category' href='category.php?category=" .$category. "'>
													" .$category. "
													</a>
												</div>
										    </div>
										</div>	
									</div>
								</div>
				   			</div>";		
				}
				if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
			}
			else {
			$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
			echo $str;
	}

	public function Updates_Categories($data, $limit, $post_type){
			$category = $data['category'];
			$post_type_var = $post_type;
			$page = $data['page'];

			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;

			$str = "";
			$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' AND category = '$category' AND post_type = '$post_type_var' ORDER BY id DESC");
			if(mysqli_num_rows($query) > 0) {

				$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;

				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$category = $row['category'];
					$title = $row['title'];
					$date = $row['date_added'];
					$post_pic = $row['post_pic'];


					if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

					$str .= "<div class='program-update-article'>
								<div class='updates-body-card'>
									<div class='row'>
										<div class='update-card-pic-sec col-md-4 col-sm-12'>
											<div class='updates-body-pic'>
												<a href='article.php?article_id=" .$id. " '>
													<img src='admin/$post_pic'>
												</a>	
											</div>
										</div>
											<div class='col-md-8 col-sm-12'>
											<div class='updates-body-title'>
												<a href='article.php?article_id=" .$id. " '>
												" .$title. "
												</a>
											</div>
											<div class='title-date-update-program'>
												<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
												<div class='updates-body-category'>
													<a href='category.php?category=" .$category. "'>
													" .$category. "
													</a>
												</div>
										    </div>
										</div>	
									</div>
								</div>
				   			</div>";		
				}
				if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
			}	
			else {
			$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
		}
			echo $str;
	}

	public function Index_Category($data, $limit){
			$page = $data['page'];

			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;

			$str = "";
			$query = mysqli_query($this->con, "SELECT * FROM posts WHERE archived ='no' ORDER BY id DESC");
			
			
			if(mysqli_num_rows($query) > 0) {

				$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;

				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$category = $row['category'];
					$title = $row['title'];
					$date = $row['date_added'];
					$post_pic = $row['post_pic'];


					if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

					$str .= "<div class='program-update-article'>
								<div class='updates-body-card'>
									<div class='row'>
										<div class='update-card-pic-sec col-md-4 col-sm-12'>
											<div class='updates-body-pic'>
												<a href='article.php?article_id=" .$id. " '>
													<img src='admin/$post_pic'>
												</a>	
											</div>
										</div>
											<div class='col-md-8 col-sm-12'>
											<div class='updates-body-title'>
											<a href='article.php?article_id=" .$id. " '>
											" .$title. "
											</a>
											</div>
											<div class='title-date-update-program'>
												<div class='updates-body-date'><i class='far fa-calendar-alt'></i>" .$date. "</div>
												
												<div class='updates-body-category'>
													<a class='hover-category' href='category.php?category=" .$category. "'>
													" .$category. "
													</a>
												</div>
										    </div>
										</div>	
									</div>
								</div>
				   			</div>";	
				   			
				}
				if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "<div style='text-align: center;'>
									<input type='hidden' class='noMorePosts' value='true'>
									<p style='text-align: centre;' class='noMorePostsText'> No more posts to show! </p>
								</div>
								<script>
									$('#button').hide();
								</script>";
			}	
			echo $str;
	}
}
?>