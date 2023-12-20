<?php
class Post_Body {
	private $user_obj;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$this->user_obj = new User($con);
	}

	public function submitPost($title, $description, $body, $date, $selcat, $seltype, $image, $userlogin, $downloadname, $downloadsize, $filename_download){
		$message = "";
		$title = $title;
		$description = $description;
		$date = $date;
		$image = $image;
		$title = ucfirst($title);
		$description = $description;
		$description = ucfirst($description);
		if($downloadsize != ""){
		   $downloadsize = number_format($downloadsize/1024/1024,2) . "MB";
		}
		else{
			$downloadsize = "";
		}
		
		$body = str_replace('\r\n', "\n", $body);
		$body = nl2br($body);
		$check_empty = preg_replace('/\s+/', '', $body); //Deltes all spaces 
		$check_emptytitle = preg_replace('/\s+/', '', $title); //Deltes all spaces
		$check_emptydate = preg_replace('/\s+/', '', $date); //Deltes all spaces
		$check_emptydescription = preg_replace('/\s+/', '', $description); //Deltes all spaces
		$check_emptyimage = preg_replace('/\s+/', '', $image); //Deltes all spaces
		if($check_empty != "" && $check_emptytitle != "" && $check_emptydescription != "" && $check_emptydate != "" && $check_emptyimage != "") {
			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$userlogin', '$title', '$body', '$date', '$selcat', '$seltype', 'no', 'no', 'no', '$image', '$description', '$downloadname', '$downloadsize', '$filename_download')");
			$message = "<div class='errormessage'><div style='text-align:center;' class='alert alert-success'>
	        Data Input Successfully! <div class='closebtn'>&times</div>
	      </div></div>";
		}
		else {
			$message = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
	        Error! Incomplete Input <div class='closebtn'>&times</div>
	      </div></div>";
		}
		return $message;
	}

	public function SubmitPost_Public_Servant($name, $position, $img){
		$message = "";
		$name = $name;
		$position = $position;
		$img = $img;
		$name = ucfirst($name);
		$position = ucfirst($position);
		
		$check_emptyname = preg_replace('/\s+/', '', $name); //Deltes all spaces 
		$check_emptyposition = preg_replace('/\s+/', '', $position); //Deltes all spaces
		$check_emptyimg = preg_replace('/\s+/', '', $img); //Deltes all spaces
		if($check_emptyname != "" && $check_emptyposition != "" && $check_emptyimg != "") {
			$query = mysqli_query($this->con, "INSERT INTO public_servants VALUES('', '$name', '$position', '$img')");
		$messageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-success'>
        Data Input Successfully! <div class='closebtn'>&times</div>
      </div></div>";
		}
		else {
			$messageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
        Failed! Incomplete Data <div class='closebtn'>&times</div>
      </div></div>";
		}
		return $messageps;
	}

	public function SubmitPost_Public_Servant_Update($id,$name, $position, $img){
		$message = "";
		$name = $name;
		$position = $position;
		$img = $img;
		$name = ucfirst($name);
		$id = $id;
		$position = ucfirst($position);
		$query = mysqli_query($this->con, "SELECT * FROM public_servants WHERE id='$id' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$check_emptyname = preg_replace('/\s+/', '', $name); //Deltes all spaces 
			$check_emptyposition = preg_replace('/\s+/', '', $position); //Deltes all spaces
			$check_emptyimg = preg_replace('/\s+/', '', $img); //Deltes all spaces
			if($check_emptyname != "" && $check_emptyposition != "" && $check_emptyimg != "") {
				$query = mysqli_query($this->con, "UPDATE public_servants SET name='$name', position='$position', profile_pic='$img' WHERE id='$id'");
				$messageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-success'>
		        Data Updated Successfully! $id img $position $name<div class='closebtn'>&times</div>
		     	</div></div>";
			}
			else {
				$messageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
		        Failed! Incomplete Data <div class='closebtn'>&times</div>
		      </div></div>";
			}
			return $messageps;
		}else {
			$messageps = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
		        Failed! Data not found in the database <div class='closebtn'>&times</div>
		      </div></div>";
		    return $messageps;  
		}
		
	}

	public function SubmitPost_Article_Update($id, $title, $description, $body, $date, $selcat, $seltype, $image, $userlogin, $downloadname, $downloadsize, $filename_download){
		$message = "";
		$title = $title;
		$description = $description;
		$date = $date;
		$image = $image;
		$title = ucfirst($title);
		$description = $description;
		$description = ucfirst($description);
		if($downloadsize != ""){
		   $downloadsize = number_format($downloadsize/1024/1024,2) . "MB";
		}
		else{
			$downloadsize = "";
		}
		$body = str_replace('\r\n', "\n", $body);
		$body = nl2br($body);
		$check_empty = preg_replace('/\s+/', '', $body); //Deltes all spaces 
		$check_emptytitle = preg_replace('/\s+/', '', $title); //Deltes all spaces
		$check_emptydate = preg_replace('/\s+/', '', $date); //Deltes all spaces
		$check_emptydescription = preg_replace('/\s+/', '', $description); //Deltes all spaces
		$check_emptyimage = preg_replace('/\s+/', '', $image); //Deltes all spaces
		$query = mysqli_query($this->con, "SELECT * FROM posts WHERE id='$id' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			if($check_empty != "" && $check_emptytitle != "" && $check_emptydescription != "" && $check_emptydate != "" && $check_emptyimage != "") {
			$query = mysqli_query($this->con, "UPDATE posts SET title='$title', description='$description', content='$body', date_added='$date', category='$selcat', post_type='$seltype', post_pic='$image', posted_by='$userlogin', file_name='$downloadname', file_size='$downloadsize', filename_download = '$filename_download' WHERE id='$id'");

			$message = "<div class='errormessage'><div style='text-align:center;' class='alert alert-success'>
	        Data Input Successfully! <div class='closebtn'>&times</div>
	      </div></div>";
			}
			else {
				$message = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
	       					 Error! Incomplete Input <div class='closebtn'>&times</div>
	      					</div></div>";
			}
			return $message;
		}else {
			$message = "<div class='errormessage'><div style='text-align:center;' class='alert alert-danger'>
	       					 Failed! Data not found in the database <div class='closebtn'>&times</div>
	      				</div></div>";
	      	return $message;			
		}
				
	}
	public function Forum_Index($data, $limit){
			$page = $data['page'];

			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;

			$str = "";
			$query = mysqli_query($this->con, "SELECT * FROM forum ORDER BY id DESC");
			
			
			if(mysqli_num_rows($query) > 0) {

				$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;

				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$question = $row['question'];
					$ask_by = $row['ask_by'];
					$date = $row['date'];
					$opened = $row['opened'];
					$viewed = $row['viewed'];
					$answered = $row['answered'];

					$query_number_comment = mysqli_query($this->con, "SELECT * FROM comment WHERE question_id='$id'");
					$numberofcomment = mysqli_num_rows($query_number_comment);


					$query_user = mysqli_query($this->con, "SELECT * FROM users WHERE username='$ask_by'");
					$row_user = mysqli_fetch_array($query_user);
					$first_name = $row_user['first_name'];
					$last_name = $row_user['last_name'];
					$pic = $row_user['profile_pic'];
					$pic = str_replace('admin/', '', $pic);
					if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

					$str .= "<div id='comment_toggle$id' class='comment_toggle_forum'>
								<div class='row'>
									<div class='col-md-1 applicants_question_img'>
										<img src='$pic'>
									</div>
									<div class='col-md-11 applicants_question_question'>
										 $question
									</div>	
								</div>
								
								<div class='applicants_question_name_date'>
									 $first_name $last_name &nbsp; $date
								</div>	
								<div style='margin: 0 0 0 10px'>
									<p style='color: ; font-weight: bold;'>Comments ($numberofcomment)</p>
								</div>
								<hr>
							</div>	
						<iframe id='forum_comment$id' class='forum_comment' src='comment_iframe.php?u=$id' scrolling='yes'></iframe>";
						?>
							<script>
								$(document).ready(function() {

								  //On click signup, hide login and show registration form
								  $("#comment_toggle<?php echo $id;?>").click(function() {
								      if($('#forum_comment<?php echo $id;?>').css('display') == 'none'){
								        $("#forum_comment<?php echo $id;?>").slideDown("fast");
								      }
								      else {
								        $("#forum_comment<?php echo $id;?>").slideUp("fast");
								      }
								  });
								});
							</script>
				   		<?php	
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
	public function Forum_Comment($id){

			$str = "";
			$query = mysqli_query($this->con, "SELECT * FROM comment WHERE question_id='$id' ORDER BY id DESC");


				while($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$comment_text = $row['comment_text'];
					$send_by_applicant = $row['send_by_applicant'];
					$opened = $row['opened'];
					$viewed = $row['viewed'];
					$date = $row['date'];


					$query_user = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_by_applicant'");
					$row_user = mysqli_fetch_array($query_user);
					$first_name = $row_user['first_name'];
					$last_name = $row_user['last_name'];
					$pic = $row_user['profile_pic'];
					$pic = str_replace('admin/', '', $pic);

					$str .= "<div class='container-fluid'>
								<div class='applicants_comments_loop'>
								    <div class='applicants_comments_img'>
										<img src='$pic'>
									</div>
									<div class='applicants_comments_answer'>
											$comment_text
										<div class='applicants_comments_name_date'>
											$first_name $last_name &nbsp; $date
										</div>
									</div>
								</div>	
								<hr style='margin: 0 61px 15px 16px;'>					
							</div>";
				}

			if($str == ""){ $str.= "<p style='margin: 0 0 0 20px;'>No reply yet...</p>";}
			echo $str;
	}		
}

?>		