<?php
/**
 * 
 */
class E_S extends R_A_P_1
{
    function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
        $this->gn_div_or_address = $attributeArray['estate'];
		$this->u_type = "es";
	}

	public function approve_application($application)
	{
        $application->approve($this->u_type);
	}
    public function getGnDivOrAddress()
    {
        return $this->gn_div_or_address;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function getDs()
    {
        throw new Exception("No District Secretariat for Estate Residence applications");
    }

}
