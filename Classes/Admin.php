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
		$application->setApprovedDate();
		$this->db->save_state_of_application($application);
	}

	public function reject_application($application,$notification){
		$application->reject($this,$notification);
		$this->db->save_state_of_application($application);
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
		return $application->getApplicationDetails();
	}

	function visitNotification($notification)
	{
		return $notification->getNotificationDetails();
	}
}


?>
