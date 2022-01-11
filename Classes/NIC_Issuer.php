<?php

/**
 *
 */
class NIC_Issuer extends L_P_User implements IApprover
{
    private $staff_id;

    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->u_type = "ni";
        $this->staff_id = $attributeArray['staff_id'];
    }

    public function fetch_NIC_details($value = '')
    {
        // code...
    }

    public function issue_NIC($value = '')
    {
        // code...
    }

    /**
     * @throws Exception
     */
    public function getGnDivOrAddress()
    {
        throw new Exception("No divisions for NIC Issuer");
    }

    /**
     * @return void
     * @throws Exception
     */
    public function getDs()
    {
        throw new Exception("No divisions for NIC Issuer");
    }
}


