<?php
/**
 *
 */
class Admin extends L_P_User
{
	public function __construct($attributeArray)
	{
		$this->u_type = "admin";
		$db = DB_OP::get_connection();
	}

	public function approve_application($application)
	{
		$db->approve_application($application_id,"level 3");
	}

}


?>
