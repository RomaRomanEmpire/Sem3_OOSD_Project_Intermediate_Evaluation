<?php
/**
 *
 */
class Admin extends L_P_User implements IVisitor
{
	private $staff_id;

	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
		$this->u_type = "admin";
		$this->staff_id = $attributeArray['staff_id'];
	}

	public function approve_application($application)
	{
		$application->approve($this);
		$this->db->add_sign_to_application($application->getRowId(), $application);
	}

	public function reject_application($application,$notification){
		$application->reject($this,$notification);
		$this->db->add_sign_to_application($application->getRowId(), $application);
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
