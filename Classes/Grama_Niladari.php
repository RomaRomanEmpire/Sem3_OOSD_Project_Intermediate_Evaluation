<?php
/**
 * 
 */
class GramaNiladari extends R_A_P_1
{
	
	public function __construct($objectArray)
	{
		super($objectArray);
		$u_type="gn";
	}

	public function approve_application($application)
	{
		$db->approve_application($application_id,"level 1");
	}
}
?>