<?php
/**
 * 
 */
class Principal extends R_A_P_1
{
	
	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
		$this->u_type = "principal";
	}
	public function approve_application($application)
	{
		$db->approve_application($application_id,"level 2");
	}
}
?>