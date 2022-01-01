<?php
/**
 * 
 */
class Principal extends R_A_P_1
{
    public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
        $this->gn_div_or_address = $attributeArray['school'];
		$this->u_type = "principal";
	}
	public function approve_application($application)
	{
		$application->getState()->approve();
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
        throw new Exception("No District Secretariat for School applications");
    }
}
