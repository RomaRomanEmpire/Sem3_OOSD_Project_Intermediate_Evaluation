<?php

/**
 *
 */
class Admin extends L_P_User implements IVisitor
{
    private $staff_id;

    public function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->u_type = "admin";
        $this->staff_id = $attributeArray['staff_id'];
    }

    public function approve_application($application, $notification)
    {
        $application->approve($this, $notification);
        $application->setApprovedDate();
        $this->db->save_state_of_application($application);
    }

    public function reject_application($application, $notification)
    {
        $application->reject($this, $notification);
        $this->db->save_state_of_application($application);
        $this->db->delete_row('application_details', 'app_id', $application->getRowId());
    }

    /**
     * @throws Exception
     */
    public function getGnDivOrAddress()
    {
        throw new Exception("No divisions for Admin");
    }

    /**
     * @return void
     * @throws Exception
     */
    public function getDs()
    {
        throw new Exception("No divisions for Admin");
    }

    function visitApplication($application)
    {
        return $application->getApplicationDetails();
    }

    function visitNotification($notification)
    {
        return $notification->getNotificationDetails();
    }

    public function fetch_value($table, $key, $key_value, $object)
    {
        return $this->db->get_column_value($table, $key, '=', $key_value, $object, "");
    }

    public function fetch_array($table, $key, $key_value, $order)
    {
        return $this->db->database_details($table, $key, $key_value, $order);
    }

    public function fetch_array_2($table, $key1, $key2, $operator1, $operator2, $key_value1, $key_value2, $order)
    {
        return $this->db->database_details_2($table, $key1, $key2, $operator1, $operator2, $key_value1, $key_value2, $order);
    }

    public function fetch_value_3($table, $key1, $key2, $key3, $key_value1, $key_value2, $key_value3, $object)
    {
        return $this->db->get_column_value3($table, $key1, $key2, $key3, $key_value1, $key_value2, $key_value3, $object);
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }



}