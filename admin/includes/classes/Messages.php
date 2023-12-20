<?php
class Messages{
	private $user_obj;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$this->user_obj = new User($con);
	}
	public function messages_inbox($data, $limit){
	$page = $data['page'];
		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;
	$str = "";
	$query = mysqli_query($this->con, "SELECT * FROM messages ORDER BY id DESC");
	if(mysqli_num_rows($query) > 0) {
		$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;
	while($row = mysqli_fetch_array($query)) {
		$id = $row['id'];
		$request_category = $row['request_category'];
		$request_suggestion = $row['request_suggestion'];
		$download_name = $row['download_name'];
		$download_size = $row['download_size'];
		$opened = $row['opened'];
		$viewed = $row['viewed'];
		$date = $row['date'];
		$send_by = $row['send_by'];
		$send_to = $row['send_to'];
		$send_to_admin = $row['send_to_admin'];
		if($send_by != ""){
			$query_img = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_by'");
			$row_img = mysqli_fetch_array($query_img);
			$img = $row_img['profile_pic'];	
			$img_message = str_replace('admin/', '', $img);
			$first_name = $row_img['first_name'];
			$last_name = $row_img['last_name'];
			

			$dots_category = (strlen($request_category) >= 15) ? "..." : "";
			$request_category = str_split($request_category, 15);
			$request_category = $request_category[0] . $dots_category; 
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}
			
			$str .= "<a href='messages.php?u=$id'>
					 <div class='row dropdown_message_box'>
						<div class='dropdown_message_box_div col-md-12'>
							<div class='img_message'>
								<img src='$img_message'>
							</div>
							<div class='message_dropdown_content'>
								
								<div class='message_category'>
									$request_category
								</div>
								<div class='message_date'>
									$date
								</div>
								<div class='message_suggestion' style='margin-right: 6px;'>
									Sent by: $first_name $last_name
								</div>
								
							</div>
						</div>
					 </div>";	
		}
		else{
			$str .= "";
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

	public function messages_inbox_user($data, $limit){
	$page = $data['page'];
	$userLoggedIn = $data['userLoggedIn'];
		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;
	$str = "";
	$query = mysqli_query($this->con, "SELECT * FROM messages WHERE send_to='$userLoggedIn' ORDER BY id DESC");
	if(mysqli_num_rows($query) > 0) {
		$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;
	while($row = mysqli_fetch_array($query)) {
		$id = $row['id'];
		$request_category = $row['request_category'];
		$request_suggestion = $row['request_suggestion'];
		$download_name = $row['download_name'];
		$download_size = $row['download_size'];
		$opened = $row['opened'];
		$viewed = $row['viewed'];
		$date = $row['date'];
		$send_by = $row['send_by'];
		$send_to = $row['send_to'];
		$send_to_admin = $row['send_to_admin'];
		if($send_to != ""){

				
			$rand = rand(0,17); //Random number between 1 and 2

			if($rand == 1)
				$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
			else if($rand == 2)
				$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
			else if($rand == 3)
				$profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
			else if($rand == 4)
				$profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
			else if($rand == 5)
				$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
			else if($rand == 6)
				$profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
			else if($rand == 7)
				$profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
			else if($rand == 8)
				$profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
			else if($rand == 9)
				$profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
			else if($rand == 10)
				$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
			else if($rand == 11)
				$profile_pic = "assets/images/profile_pics/defaults/head_pumpkin.png";
			else if($rand == 12)
				$profile_pic = "assets/images/profile_pics/defaults/head_red.png";
			else if($rand == 13)
				$profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
			else if($rand == 14)
				$profile_pic = "assets/images/profile_pics/defaults/head_turqoise.png";
			else if($rand == 15)
				$profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
			else if($rand == 16)
				$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";


			$dots_category = (strlen($request_category) >= 26) ? "..." : "";
			$request_category = str_split($request_category, 26);
			$request_category = $request_category[0] . $dots_category; 
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}
			
			$str .= "<a href='messages_user.php?u=$id'>
					 <div class='row dropdown_message_box'>
						<div class='dropdown_message_box_div col-md-12'>
							<div class='img_message'>
								<img src='$profile_pic'>
							</div>
							<div class='message_dropdown_content'>
								
								<div class='message_category'>
									$request_category
								</div>
								<div class='message_date' style='display: block;'>
									$date
								</div>
								
							</div>
						</div>
					 </div>";	
		}
		else{
			$str .= "";
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

	public function messages_outbox($data, $limit){
	$page = $data['page'];
		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;
	$str = "";
	$query = mysqli_query($this->con, "SELECT * FROM messages ORDER BY id DESC");
	if(mysqli_num_rows($query) > 0) {
		$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;
	while($row = mysqli_fetch_array($query)) {
		$id = $row['id'];
		$request_category = $row['request_category'];
		$request_suggestion = $row['request_suggestion'];
		$download_name = $row['download_name'];
		$download_size = $row['download_size'];
		$opened = $row['opened'];
		$viewed = $row['viewed'];
		$date = $row['date'];
		$send_by = $row['send_by'];
		$send_to = $row['send_to'];
		$send_to_admin = $row['send_to_admin'];
		if($send_to_admin != ""){

			$query_to = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_to'");
			$row_to = mysqli_fetch_array($query_to);
			$first_name_applicant = $row_to['first_name'];
			$last_name_applicant = $row_to['last_name'];


			$query_img = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_to_admin'");
			$row_img = mysqli_fetch_array($query_img);

			$img = $row_img['profile_pic'];	
			$img_message = str_replace('admin/', '', $img);

			

			$dots_category = (strlen($request_category) >= 15) ? "..." : "";
			$request_category = str_split($request_category, 15);
			$request_category = $request_category[0] . $dots_category; 
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}
			
			$str .= "<a href='messages_admin.php?u=$id'>
					 <div class='row dropdown_message_box'>
						<div class='dropdown_message_box_div col-md-12'>
							<div class='img_message'>
								<img src='$img_message'>
							</div>
							<div class='message_dropdown_content'>
								
								<div class=' message_category'>
									$request_category
								</div>
								<div class='message_date'>
									$date
								</div>
								<div class='message_suggestion' style='margin-right: 6px;'>
									Sent to: $first_name_applicant $last_name_applicant
								</div>

							</div>
						</div>
					 </div>";	
		}
		else{
			$str .= "";
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

	public function messages_output_inbox($id){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE id='$id'");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);

			$request_category = $row['request_category'];
			$request_suggestion = $row['request_suggestion'];
			$download_name = $row['download_name'];
			$download_size = $row['download_size'];
			$opened = $row['opened'];
			$viewed = $row['viewed'];
			$date = $row['date'];
			$send_by = $row['send_by'];
			$send_to = $row['send_to'];
			$send_to_admin = $row['send_to_admin'];
			$download_name_screen = $row['download_name_screen'];

			if (strpos($download_name_screen, '.pdf') == true) {
			    $link_please = "<a href='../$download_name' target='_blank' title='View'>";
			    $link_please_end = "</a>";
			}
			else {
				$link_please = "<span>";
				$link_please_end = "</span>";
			}

			$query_user = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_by'");
			$row_user = mysqli_fetch_array($query_user);
			$first_name = $row_user['first_name'];
			$last_name = $row_user['last_name'];
			$str .= "<div class='message_by_id_box'>
						<div class='message_by_id_category'>
							<p>Request:</p> 
							<div class='request_category_message'>$request_category</div>
						</div>";
		if($request_suggestion != ""){				
			$str.="			
						<div class='message_by_id_suggestion'>
							<p>Message:</p> 
							<div class='request_suggestion_message'>$request_suggestion</div>
						</div>";
		}		

		if($download_name_screen != ""){			
			$str.="			
						<div class='message_by_id_downloadable'>
							<p>Sent File:</p> 
							<div class='download_screen_message'>
								$link_please $download_name_screen $link_please_end
								<a class='link_file' href='messages.php?u=$id&downloadable_file=$download_name'>Download</a>
							</div>
						</div>
					 </div>
						";
		}/* End if */ 	
		
			$str.="<!-- The Modal -->
					  <div class='modal fade' id='reply'>
					    <div class='modal-dialog modal-dialog-centered'>
					      <div class='modal-content'>
					      
					        <!-- Modal Header -->
					        <div class='modal-header'>
					          <h4 class='modal-title'>Reply to $first_name $last_name</h4>
					        </div>
					        
					        <!-- Modal body -->
					        <div class='modal-body'>
					          <iframe src='submit_reply.php?reply_to=$send_by' id='reply_iframe' scrolling='no'></iframe>
					        </div> 

					        <!-- Modal footer -->
					        <div class='modal-footer'>
					          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					        </div>
					      </div>
					    </div>
					  </div>";		
		}
		return $str;
	}	

	public function messages_output_inbox_admin($id){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE id='$id'");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);

			$request_category = $row['request_category'];
			$request_suggestion = $row['request_suggestion'];
			$download_name = $row['download_name'];
			$download_size = $row['download_size'];
			$opened = $row['opened'];
			$viewed = $row['viewed'];
			$date = $row['date'];
			$send_by = $row['send_by'];
			$send_to = $row['send_to'];
			$send_to_admin = $row['send_to_admin'];
			$download_name_screen = $row['download_name_screen'];
			if (strpos($download_name_screen, '.pdf') == true) {
			    $link_please = "<a href='../$download_name' target='_blank' title='View'>";
			    $link_please_end = "</a>";
			}
			else {
				$link_please = "<span>";
				$link_please_end = "</span>";
			}

			$query_user = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_to'");
			$row_user = mysqli_fetch_array($query_user);
			$first_name = $row_user['first_name'];
			$last_name = $row_user['last_name'];
		if($request_category != ""){
			$str .= "<div class='message_by_id_box'>
				<div class='message_by_id_category'>
					<p>Description:</p> 
					<div class='request_category_message'>$request_category</div>
				</div>";
		}	
			
		if($request_suggestion != ""){				
			$str.="			
						<div class='message_by_id_suggestion'>
							<p>Message:</p> 
							<div class='request_suggestion_message'>$request_suggestion</div>
						</div>";
		}		

		if($download_name_screen != ""){			
			$str.="			
						<div class='message_by_id_downloadable'>
							<p>Sent File:</p> 	
							<div class='download_screen_message'>
								$link_please $download_name_screen $link_please_end
								<a class='link_file' href='messages.php?u=$id&downloadable_file=$download_name'>Download</a>
							</div>
						</div>
					 </div>
						";
		}/* End if */ 	
			$str .= "<div class='message_by_id_box'>
						<div class='message_by_id_category'>
							<p>Send to:</p> 
							<div class='request_category_message'>$first_name $last_name</div>
					 </div>";

		}
		return $str;
	}		

	public function messages_output_inbox_user($id){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE id='$id'");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);

			$request_category = $row['request_category'];
			$request_suggestion = $row['request_suggestion'];
			$download_name = $row['download_name'];
			$download_size = $row['download_size'];
			$opened = $row['opened'];
			$viewed = $row['viewed'];
			$date = $row['date'];
			$send_by = $row['send_by'];
			$send_to = $row['send_to'];
			$send_to_admin = $row['send_to_admin'];
			$download_name_screen = $row['download_name_screen'];

			if (strpos($download_name_screen, '.pdf') == true) {
			    $link_please = "<a href='../$download_name' target='_blank' title='View'>";
			    $link_please_end = "</a>";
			}
			else {
				$link_please = "<span>";
				$link_please_end = "</span>";
			}


			$str .= "<div class='message_by_id_box'>
						<div class='message_by_id_category'>
							<p>Request:</p> 
							<div class='request_category_message'>$request_category</div>
						</div>";
		if($request_suggestion != ""){				
			$str.="			
						<div class='message_by_id_suggestion'>
							<p>Message:</p> 
							<div class='request_suggestion_message'>$request_suggestion</div>
						</div>";
		}		

		if($download_name_screen != ""){			
			$str.="			
						<div class='message_by_id_downloadable'>
							<p>Sent File:</p> 
							<div class='download_screen_message'>
								$link_please $download_name_screen $link_please_end
								<a class='link_file' href='messages_user.php?u=$id&downloadable_file=$download_name'>Download</a>
							</div>
						</div>
					 </div>
						";
		}/* End if */ 	
		
			$str.="<!-- The Modal -->
					  <div class='modal fade' id='reply'>
					    <div class='modal-dialog modal-dialog-centered'>
					      <div class='modal-content'>
					      
					        <!-- Modal Header -->
					        <div class='modal-header'>
					          <h4 class='modal-title'>Reply to Admin</h4>
					        </div>
					        
					        <!-- Modal body -->
					        <div class='modal-body'>
					          <iframe src='submit_reply_user.php?' id='reply_iframe' scrolling='no'></iframe>
					        </div> 

					        <!-- Modal footer -->
					        <div class='modal-footer'>
					          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					        </div>
					      </div>
					    </div>
					  </div>";		
		}
		return $str;
	}		
	public function messages_outbox_user($data, $limit){
	$page = $data['page'];
	$userLoggedIn = $data['userLoggedIn'];
		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;
	$str = "";
	$query = mysqli_query($this->con, "SELECT * FROM messages WHERE send_by ='$userLoggedIn' ORDER BY id DESC");
	if(mysqli_num_rows($query) > 0) {
		$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;
	while($row = mysqli_fetch_array($query)) {
		$id = $row['id'];
		$request_category = $row['request_category'];
		$request_suggestion = $row['request_suggestion'];
		$download_name = $row['download_name'];
		$download_size = $row['download_size'];
		$opened = $row['opened'];
		$viewed = $row['viewed'];
		$date = $row['date'];
		$send_by = $row['send_by'];
		$send_to = $row['send_to'];
		$send_to_admin = $row['send_to_admin'];
		if($send_by != ""){

			$query_img = mysqli_query($this->con, "SELECT * FROM users WHERE username='$send_by'");
			$row_img = mysqli_fetch_array($query_img);

			$img = $row_img['profile_pic'];	
			$img_message = str_replace('admin/', '', $img);

			

			$dots_category = (strlen($request_category) >= 24) ? "..." : "";
			$request_category = str_split($request_category, 24);
			$request_category = $request_category[0] . $dots_category; 
			if($num_iterations++ < $start)
							continue; 


						//Once 10 posts have been loaded, break
						if($count > $limit) {
							break;
						}
						else {
							$count++;
						}
			
			$str .= "<a href='messages_admin_user.php?u=$id'>
					 <div class='row dropdown_message_box'>
						<div class='dropdown_message_box_div col-md-12'>
							<div class='img_message'>
								<img src='$img_message'>
							</div>
							<div class='message_dropdown_content'>
								
								<div class=' message_category'>
									$request_category
								</div>
								<div class='message_date' style='display: block;'>
									$date
								</div>

							</div>
						</div>
					 </div>";	
		}
		else{
			$str .= "";
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
	public function messages_output_inbox_admin_user($id){
		$str = "";
		$query = mysqli_query($this->con, "SELECT * FROM messages WHERE id='$id'");
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);

			$request_category = $row['request_category'];
			$request_suggestion = $row['request_suggestion'];
			$download_name = $row['download_name'];
			$download_size = $row['download_size'];
			$opened = $row['opened'];
			$viewed = $row['viewed'];
			$date = $row['date'];
			$send_by = $row['send_by'];
			$send_to = $row['send_to'];
			$send_to_admin = $row['send_to_admin'];
			$download_name_screen = $row['download_name_screen'];
			if (strpos($download_name_screen, '.pdf') == true) {
			    $link_please = "<a href='../$download_name' target='_blank' title='View'>";
			    $link_please_end = "</a>";
			}
			else {
				$link_please = "<span>";
				$link_please_end = "</span>";
			}

		if($request_category != ""){
			$str .= "<div class='message_by_id_box'>
				<div class='message_by_id_category'>
					<p>Description:</p> 
					<div class='request_category_message'>$request_category</div>
				</div>";
		}	
			
		if($request_suggestion != ""){				
			$str.="			
						<div class='message_by_id_suggestion'>
							<p>Message:</p> 
							<div class='request_suggestion_message'>$request_suggestion</div>
						</div>";
		}		

		if($download_name_screen != ""){			
			$str.="			
						<div class='message_by_id_downloadable'>
							<p>Sent File:</p> 	
							<div class='download_screen_message'>
								$link_please $download_name_screen $link_please_end
								<a class='link_file' href='messages.php?u=$id&downloadable_file=$download_name'>Download</a>
							</div>
						</div>
					 </div>
						";
		}/* End if */ 	

		}
		return $str;
	}			
	public function getConvosDropdown($data, $limit) {
		$userLoggedIn = $data['userLoggedIn'];
		$page = $data['page'];
		$return_string = "";
		$convos = array();

		if($page == 1)
			$start = 0;
		else 
			$start = ($page - 1) * $limit;

		$set_viewed_query = mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE send_by='$userLoggedIn'");

		$query = mysqli_query($this->con, "SELECT * FROM messages ORDER BY id DESC");

		while($row = mysqli_fetch_array($query)) {
			$user_to_push = ($row['send_by'] == "") ? $row['send_to'] : $row['send_by'];

			if(!in_array($user_to_push, $convos)) {
				array_push($convos, $user_to_push);
			}
		}

		$num_iterations = 0; //Number of messages checked 
		$count = 1; //Number of messages posted

		foreach($convos as $username) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else 
				$count++;


			$is_unread_query = mysqli_query($this->con, "SELECT * FROM messages WHERE send_to='$username' OR send_by='$username' ORDER BY id DESC");
			$row_new = mysqli_fetch_array($is_unread_query);
			$request_category = $row_new['request_category'];
			$request_suggestion = $row_new['request_suggestion'];
			$date = $row_new['date'];
			$send_to = $row_new['send_to'];
			$send_by = $row_new['send_by'];
			if($send_to == ""){
				$user_point = $send_by;
			}else{
				$user_point = $send_to;
			}

			$is_unread_query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$user_point' ORDER BY id DESC");
			$row_point = mysqli_fetch_array($is_unread_query);
			$first_name = $row_point['first_name'];
			$last_name = $row_point['last_name'];
			$profile_pic = $row_point['profile_pic'];
			$profile_pic = str_replace("admin/","", "$profile_pic");

			$dots = (strlen($request_category) >= 26) ? "..." : "";
			$request_category = str_split($request_category, 26);
			$request_category = $request_category[0] . $dots; 

			$return_string .= 
			"<div class='drop_message_bar'>

					<div class='drop_message_bar_img'>
						<img src='$profile_pic'>
					</div>
					<div class='drop_message_bar_message'>
						<div class='drop_message_bar_message_2'>
							$request_category
						</div>
						<div class='drop_message_bar_name_date'>
							Sent by: $first_name $last_name<br>$date
						</div>
					</div>

			</div>";
		}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else 
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>No more messages to load!</p>";

		return $return_string;
	}	
}	
?>	