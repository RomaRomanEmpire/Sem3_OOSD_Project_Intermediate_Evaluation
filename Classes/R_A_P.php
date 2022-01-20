<?php

abstract class R_A_P extends L_P_User implements IApprover, IVisitor
{
    private $staff_id;

    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->staff_id = $attributeArray['staff_id'];
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }

    public function updateApplicationDetails($application)
    {
        $this->db->save_state_of_application($application);
    }

    public function approve_application($application,$notification)
    {
        $application->approve($this,$notification);
        $this->db->save_state_of_application($application);

    }
    public function reject_application($application,$notification){
        $application->reject($this,$notification);
        $this->db->save_state_of_application($application);
        $this->db->delete_row('application_details','app_id', $application->getRowId());
    }

    function visitApplication($application)
    {
        return $application->getApplicationDetails();
    }

    function visitNotification($notification)
    {
        return $notification->getNotificationDetails();
    }

    public function fetch_value($table, $key, $key_value, $object){
        return $this->db->get_column_value($table, $key, '=', $key_value, $object,"");
    }

    public function fetch_value_3($table, $key1, $key2, $key3, $key_value1, $key_value2, $key_value3, $object){
        return $this->db->get_column_value3($table,$key1,$key2, $key3,$key_value1, $key_value2, $key_value3,$object);
    }

    public function fetch_array($table, $key, $key_value,$order){
        return $this->db->database_details($table,$key, $key_value, $order);
    }

    public function fetch_array_2($table, $key1, $key2,$operator1, $operator2, $key_value1, $key_value2, $order){
        return $this->db->database_details_2($table,$key1, $key2, $operator1, $operator2, $key_value1, $key_value2, $order);
    }







}