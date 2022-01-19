<?php

include 'NIC.php';
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

//    public function fetch_NIC_details($value = '')
//    {
//        // code...
//    }

    public function issue_NIC($applicant_id, $application, $details)
    {
        $nic =  new NIC($details);
        $this->db->issue_NIC($application->getRowId(), $nic);
        $this->db->application_processed($applicant_id, $application);
        $this->db->remove_application('app_id', $application->getRowId());
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


