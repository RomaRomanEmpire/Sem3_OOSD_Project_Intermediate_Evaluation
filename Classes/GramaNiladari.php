<?php
/**
 * 
 */
class GramaNiladari extends R_A_P_1
{
    private $divisional_secretariat;
	public function __construct($attributeArray)
	{
		parent::__construct($attributeArray);
        $this->gn_div_or_address = $attributeArray['gdivision'];
        $this->divisional_secretariat = $attributeArray['ds1'];
		$this->u_type="gn";
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
        return $this->divisional_secretariat;
    }

}
