<?php
/**
 *
 */
class Admin extends L_P_User implements IVisitor
{
	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
		$this->u_type = "admin";
		$db = DB_OP::get_connection();
	}

	public function approve_application($application)
	{
//		$db->approve_application($application_id,"level 3");
	}
	/**
	 * @throws Exception
	 */
	public function getGnDivOrAddress()
	{
		throw new Exception("No divisions for Admin");
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function getDs()
	{
		throw new Exception("No divisions for Admin");
	}

	function visitApplication($application)
	{
		// TODO: Implement visitApplication() method.
	}

	function visitNotification($notification)
	{
		// TODO: Implement visitNotification() method.
	}
}


?>
