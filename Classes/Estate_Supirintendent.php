<?php
/**
 * 
 */
class E_S extends R_A_P_1
{
	
	function __construct($objectArray)
	{
		super($objectArray);
		$u_type = "es";
	}

	public function approve_application($application)
	{
		$db->approve_application($application_id,"level 2");
	}
}
?>