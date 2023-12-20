<?php
class PostCategory_Content {
	private $user_obj;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$this->user_obj = new User($con);
	}

	public function PostCategory_Content(){
		$query = mysqli_query($con, "SELECT * FROM posts WHERE archived ='no' AND post_type = '$post_type' AND category='$category' ORDER BY id DESC");
	}
}
?>	