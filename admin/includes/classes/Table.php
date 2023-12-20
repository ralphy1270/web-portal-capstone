<?php
class Post {
	private $con;

	public function __construct($con){
		$this->con = $con;
	}
		public function Downloadable($data, $limit){
		$page = $data['page'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$date = $row['date_added'];
			$name = $row['file_name'];
			$size = $row['file_size'];
			$filename_download = $row['filename_download'];
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}
			if($name!=""){
			$str .= "
					 <tr>
					 	<td>$date</td>
				        <td>$filename_download</td>
				        <td>$size</td>
				        <td style='text-align: center;'>
				        	<a href='downloadable-files-table.php?name=$name' class='btn btn-info' style='margin-right:0.5rem;'>
				        		Download
				        	</a>
				        	<a href='../article.php?article_id=$id' class='btn btn-primary' target='_blank'>
				        		See Info
				        	</a>
				        </td>
				      </tr>";	
		    }
		    else {
		    	continue;
		    }
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}

	public function Table_Article($data, $limit){
		$page = $data['page'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$title = $row['title'];
			$posted_by = $row['posted_by'];
			$date = $row['date_added'];
			$category = $row['category'];
			$post_type = $row['post_type'];
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 12rem;'>	
			<form action='articletable.php?edit=$id' method='POST'>
 		    <input type='submit' class='btn btn-info btn-xs' name='edit' value='Edit' style='outline: 0;'>
		    <button type='button' class='btn btn-danger btn-xs' id='articlepost$id' style='outline: 0;'>Delete</button>
		    </form>
  		</td>
		<td>$title</td>
		<td>$posted_by</td>
		<td>$date</td>
		<td>$category</td>
		<td>$post_type</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}
	public function Table_Public_Servants($data, $limit){
		$page = $data['page'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM public_servants ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$name = $row['name'];
			$position = $row['position'];
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 12rem;'>	
			<form action='view-public-servants-table.php?edit=$id' method='POST'>
 		    <input type='submit' class='btn btn-info btn-xs' name='edit' value='Edit' style='outline: 0;'>
		    <button type='button' class='btn btn-danger btn-xs' id='psprofile$id' style='outline: 0;'>Delete</button>
		    </form>
  		</td>
		<td>$name</td>
		<td>$position</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}
	public function Table_Admin($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and (user_type ='admin' OR user_type ='unapprove')  ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$username = $row['username'];
			$email = $row['email'];
			$signup_date = $row['signup_date'];
			$user_type = $row['user_type'];
			$profile_pic = $row['profile_pic'];
			$bday = $row['bday'];
			$position = $row['position'];
			$button = "";
			if($user_type == "unapprove"){
				$button = "<button type='button' class='btn btn-danger btn-xs' id='profile_authorize$id' style='outline: 0; display: inline-block;'>Unauthorized</button>
						   <button type='button' class='btn btn-success btn-xs' id='profile_unauthorize$id' style='outline: 0;display: none;'>Authorized</button>";
			}
			else {
				$button = "<button type='button' class='btn btn-success btn-xs' id='profile_unauthorize$id' style='outline: 0; display: inline-block;'>Authorized</button>
					<button type='button' class='btn btn-danger btn-xs' id='profile_authorize$id' style='outline: 0; display: none;'>Unauthorized</button>";
			}

			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 20rem;' id='td$id'>	
			<button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal$id' style='outline: 0;'>Manage</button>
		    <button type='button' class='btn btn-warning btn-xs' id='profile$id' style='outline: 0;'>Archive</button>
		    $button
			<div class='modal fade' id='myModal$id' role='dialog'>
			<div class='modal-dialog'>
			    
		      <div class='modal-content'>
		        <div class='modal-header'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title'>Profile</h4>
		        </div>
		        <div class='modal-body'>
		          <div class='row'>
		          	<div class='col-md-12'>
		          		<div class='modal-body-profile'>
		          			<img src='$profile_pic'>
			          	</div>	
			          	<div class='modal-link-profile'>
		          			<span class='profile-info-modal'>Full Name:</span> $first_name $last_name
			          		<br>
			          		<span class='profile-info-modal'>Birth Date:</span> $bday
			          		<br>
			          		<span class='profile-info-modal'>Position:</span> $position
			          		<br><br>
			          		
		          		</div>
		          	</div>
		          </div>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
		        </div>
		      </div>

	    	</div>
	 		</div>
  		</td>
		<td>$first_name</td>
		<td>$last_name</td>
		<td>$username</td>
		<td>$email</td>
		<td>$signup_date</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}

	public function Table_SAdmin($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and user_type ='super admin' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$username = $row['username'];
			$email = $row['email'];
			$signup_date = $row['signup_date'];
			$user_type = $row['user_type'];
			$profile_pic = $row['profile_pic'];
			$bday = $row['bday'];
			$position = $row['position'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 12rem;'>	
			<button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal$id' style='outline: 0;'>Manage</button>
		    <button type='button' class='btn btn-warning btn-xs' id='profile$id' style='outline: 0;'>Archive</button>
			<div class='modal fade' id='myModal$id' role='dialog'>
			<div class='modal-dialog'>
			    
		      <div class='modal-content'>
		        <div class='modal-header'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title'>Profile</h4>
		        </div>
		        <div class='modal-body'>
		          <div class='row'>
		          	<div class='col-md-12'>
		          		<div class='modal-body-profile'>
		          			<img src='$profile_pic'>
			          	</div>	
			          	<div class='modal-link-profile'>
		          			<span class='profile-info-modal'>Full Name:</span> $first_name $last_name
			          		<br>
			          		<span class='profile-info-modal'>Birth Date:</span> $bday
			          		<br>
			          		<span class='profile-info-modal'>Position:</span> $position
			          		<br><br>
			          		
		          		</div>
		          	</div>
		          </div>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
		        </div>
		      </div>

	    	</div>
	 		</div>
  		</td>
		<td>$first_name</td>
		<td>$last_name</td>
		<td>$username</td>
		<td>$email</td>
		<td>$signup_date</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}
	
	public function Table_User($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and user_type ='user' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$username = $row['username'];
			$email = $row['email'];
			$signup_date = $row['signup_date'];
			$user_type = $row['user_type'];
			$profile_pic = $row['profile_pic'];
			$bday = $row['bday'];
			$position = $row['position'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 12rem;'>	
			<button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal$id' style='outline: 0;'>Manage</button>
		    <button type='button' class='btn btn-warning btn-xs' id='profile$id' style='outline: 0;'>Archive</button>
			<div class='modal fade' id='myModal$id' role='dialog'>
			<div class='modal-dialog'>
			    
		      <div class='modal-content'>
		        <div class='modal-header'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title'>Profile</h4>
		        </div>
		        <div class='modal-body'>
		          <div class='row'>
		          	<div class='col-md-12'>
		          		<div class='modal-body-profile'>
		          			<img src='$profile_pic'>
			          	</div>	
			          	<div class='modal-link-profile'>
		          			<span class='profile-info-modal'>Full Name:</span> $first_name $last_name
			          		<br>
			          		<span class='profile-info-modal'>Birth Date:</span> $bday
			          		<br>
			          		<span class='profile-info-modal'>Position:</span> $position
			          		<br><br>
			          		
		          		</div>
		          	</div>
		          </div>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
		        </div>
		      </div>

	    	</div>
	 		</div>
  		</td>
		<td>$first_name</td>
		<td>$last_name</td>
		<td>$username</td>
		<td>$email</td>
		<td>$signup_date</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}

	public function Table_Archive($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='yes' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$username = $row['username'];
			$email = $row['email'];
			$signup_date = $row['signup_date'];
			$user_type = $row['user_type'];
			$profile_pic = $row['profile_pic'];
			$bday = $row['bday'];
			$position = $row['position'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

		$str .= "
		<tr id='tr$id'>
		<td style='width: 1rem;'>$id</td>
		<td style='width: 18rem;'>	
			<button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#myModal$id' style='outline: 0;'>Manage</button>
		    <button type='button' class='btn btn-warning btn-xs' id='profile$id' style='outline: 0;'>Restore</button>
		    <button type='button' class='btn btn-danger btn-xs' id='profile_delete$id' style='outline: 0;'>Delete</button>
			<div class='modal fade' id='myModal$id' role='dialog'>
			<div class='modal-dialog'>
			    
		      <div class='modal-content'>
		        <div class='modal-header'>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		          <h4 class='modal-title'>Profile</h4>
		        </div>
		        <div class='modal-body'>
		          <div class='row'>
		          	<div class='col-md-12'>
		          		<div class='modal-body-profile'>
		          			<img src='$profile_pic'>
			          	</div>	
			          	<div class='modal-link-profile'>
		          			<span class='profile-info-modal'>Full Name:</span> $first_name $last_name
			          		<br>
			          		<span class='profile-info-modal'>Birth Date:</span> $bday
			          		<br>
			          		<span class='profile-info-modal'>Position:</span> $position
			          		<br><br>
			          		
		          		</div>
		          	</div>
		          </div>
		        </div>
		        <div class='modal-footer'>
		          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
		        </div>
		      </div>

	    	</div>
	 		</div>
  		</td>
		<td>$first_name</td>
		<td>$last_name</td>
		<td>$username</td>
		<td>$email</td>
		<td>$signup_date</td>
		</tr>";	


		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
		
		
	}

	public function Table_Admin_Script($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and (user_type ='admin' OR user_type ='unapprove') ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$username = $row['username'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#profile<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Archive this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result){
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');
								}

							});
						});


					});


					$(document).ready(function() {

						$('#profile_unauthorize<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Unauthorize this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/unauthorize-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result){
									$("#profile_unauthorize<?php echo $id; ?>").css("display", "none");
									$("#profile_authorize<?php echo $id; ?>").css("display", "inline-block");}

							});
						});


					});

					$(document).ready(function() {

						$('#profile_authorize<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Authorize this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/authorize-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result){
									 $("#profile_authorize<?php echo $id; ?>").css("display", "none");
									$("#profile_unauthorize<?php echo $id; ?>").css("display", "inline-block");}

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}

public function Table_SAdmin_Script($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and user_type ='super admin' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$username = $row['username'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#profile<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Archive this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}
	
	public function Table_User_Script($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='no' and user_type ='user' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$username = $row['username'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#profile<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Archive this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}
	public function Table_Archive_Script($data, $limit){
		$page = $data['page'];
		$useropen = $data['useropen'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE archieved ='yes' ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$username = $row['username'];
			if($username==$useropen){
				continue;
			}
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#profile<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Restore this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/restore-profile.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});


					$(document).ready(function() {

						$('#profile_delete<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Delete this profile ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-profile-final.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}
		public function Table_Public_Servants_Script($data, $limit){
		$page = $data['page'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM public_servants ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#psprofile<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Remove this Post ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-public-servant.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}
			public function Table_Article_Script($data, $limit){
		$page = $data['page'];
			if($page == 1) 
				$start = 0;
			else 
				$start = ($page - 1) * $limit;
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC");
		if(mysqli_num_rows($query) > 0) {
			$num_iterations = 0; //Number of results checked (not necasserily posted)
				$count = 1;
		while($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}

				?>
				<script>

					$(document).ready(function() {

						$('#articlepost<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to Remove this Post ID number <?php echo $id; ?>?", function(result) {

								$.post("includes/form_handlers/delete-article-post.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									$('#tr<?php echo $id; ?>').load(document.URL +  ' #tr<?php echo $id; ?>');

							});
						});


					});

				</script>
				<?php
		
			}//end while loop
			if($count > $limit) 
					$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
								<input type='hidden' class='noMorePosts' value='false'>";
					else 
						$str .= "
									<input type='hidden' class='noMorePosts' value='true'>
								
								";
		}

		echo $str;
	}
}
?>