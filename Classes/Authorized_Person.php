<?php
/**
 * 
 */
class AuthorizedPPerson extends R_A_P_1
{
	
	function __construct($attributeArray)
	{
		super($attributeArray);
		$u_type = "aup";
	}

	public function approve_application($application)
	{
        $application->approve();
	}
}
