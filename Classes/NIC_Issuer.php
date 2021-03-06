<?php

include 'NIC.php';

/**
 *
 */
class NIC_Issuer extends L_P_User implements IApprover, IVisitor
{
    private $staff_id;

    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->u_type = "ni";
        $this->staff_id = $attributeArray['staff_id'];
    }

    function visitApplication($application)
    {
        return $application->getApplicationDetails();
    }

    /**
     * @throws Exception
     */
    function visitNotification($notification)
    {
        throw new Exception('No notifications for NIC Issuer');
    }

    /**
     * @throws Exception
     */
    function visitNIC($nic)
    {
        throw new Exception('No NIC"S views for NIC Issuer');
    }

    public function issue_NIC($applicant_id, $application, $details)
    {
        $nic = new NIC($details);
        $nic->setIssuedDate();
        $this->db->issue_NIC($application->getRowId(), $nic);
        $this->db->application_processed($applicant_id, $application);
        $this->db->delete_row('application_details', 'app_id', $application->getRowId());
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

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }

    public function fetch_value($table, $key, $key_value, $object)
    {
        return $this->db->get_column_value($table, $key, '=', $key_value, $object, "");
    }

    public function fetch_array($table, $key, $key_value)
    {
        return $this->db->database_details($table, $key, $key_value, "");
    }


}


