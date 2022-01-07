<?php
/**
 * 
 */
class GramaNiladari extends R_A_P_1
{

	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
        $this->gn_div_or_address = $attributeArray['gdivision'];
        $this->ds = $attributeArray['ds'];
		$this->u_type="gn";
	}

	public function approve_application($application)
	{
        $application->approve($this->u_type);
	}

    /**
     * @return mixed
     */
    public function getGnDivOrAddress()
    {
        return $this->gn_div_or_address;
    }

    /**
     * @return mixed
     */
    public function getDs()
    {
        return $this->ds;
    }

}
