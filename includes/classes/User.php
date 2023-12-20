<?php
class User {
	private $user;
	private $con;

	public function __construct($con){
		$this->con = $con;
		$query = mysqli_query($this->con, "SELECT * FROM about");
		$this->user = mysqli_fetch_array($query);
	}

	public function address() {
		return $this->user['address'];
	}
	public function contact() {
		return $this->user['contact'];
	}
	public function email() {
		return $this->user['email'];
	}
	public function fb() {
		return $this->user['fb'];
	}
	public function ig() {
		return $this->user['ig'];
	}
	public function mission() {
		return $this->user['mission'];
	}
	public function vission() {
		return $this->user['vission'];
	}
	public function general_info() {
		return $this->user['general_info'];
	}
	public function info_footer() {
		return $this->user['info_footer'];
	}
	public function Additional_Services() {
		return $this->user['additional_services'];
	}
}

?>