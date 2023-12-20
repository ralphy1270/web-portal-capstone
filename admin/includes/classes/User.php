<?php
class User {
	private $user;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$query = mysqli_query($this->con, "SELECT * FROM about");
		$this->user = mysqli_fetch_array($query);
	}
}	