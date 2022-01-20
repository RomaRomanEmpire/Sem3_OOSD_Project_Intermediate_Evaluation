<?php
/**
 * 
 */
class Authorized_Person extends R_A_P_1
{
	
	function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
		$this->u_type = "aup";
	}
    public function getGnDivOrAddress()
    {
        throw new Exception("No District Secretariat for Authorized Person");
    }

    /**
     * @return void
     * @throws Exception
     */
    public function getDs()
    {
        throw new Exception("No District Secretariat for Authorized Person");
    }
}
