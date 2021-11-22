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

	protected $gender;
	protected $bday;
	protected $address;
	protected $db;
	protected $row_id;
	protected $u_type;

	function __construct($attributeArray)
	{
		$this->fname = $attributeArray['fname'];
		$this->uname = $attributeArray['uname'];
		$this->email = $attributeArray['email'];
		$this->mobile_no = $attributeArray['mobileNo'];
		$this->password = $attributeArray['password'];
	}


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
}
?>
