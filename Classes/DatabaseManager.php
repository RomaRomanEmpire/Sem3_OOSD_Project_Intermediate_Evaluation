<?php
/**
 *
 */
class DatabaseManager extends User
{
	
	
	private $staff_id;

	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
		$this->u_type = "db_manager";
	}

	public function add_L_P_User($staff_id,$u_type,$username,$email,$pwd,$u_object)
	{
		$db->create_staff_acc($staff_id,$u_type,$username,$email,$pwd,$u_object);
	}
	public function remove_L_P_User($staff_id)
	{
		$db->remove_staff_acc($staff_id);
	}
	public static function getDBManager()
	{
		return $this;
	}

}

?>
