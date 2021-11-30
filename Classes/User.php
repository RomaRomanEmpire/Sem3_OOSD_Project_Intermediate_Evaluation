<?php
/**
 *
 */
abstract class User
{
	protected $fname;
	protected $uname;
	protected $email;
	protected $mobile_no;
	protected $password;

	protected $db;
	protected $row_id;
	protected $u_type;
	// protected static $user;

	function __construct($attributeArray)
	{
		$this->fname = $attributeArray['fname'];
		$this->uname = $attributeArray['uname'];
		$this->email = $attributeArray['email'];
		$this->mobile_no = $attributeArray['mobileNo'];
		$this->password = $attributeArray['password'];
	}

	public function set_row_id($row_id){
		$this->row_id = $row_id;
	}
	public function set_db($db){
		$this->db = $db;
	}
	// public static function set_user($user){
	// 	self::$user = $user;
	// }
	public function get_user_type(){
		return $this->u_type;
	}
	public function get_user_name(){
		return $this->uname;
	}
	public function get_user_email(){
		return $this->email;
	}
	public function get_user_pwd(){
		return $this->password;
	}
	// public static function get_user(){
	// 	return self::$user;
	// }
	// public static function conn_stat()
	// {
	// 	return $this->db;
	// }
	
}
?>
