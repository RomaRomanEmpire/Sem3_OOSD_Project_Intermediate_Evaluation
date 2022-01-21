<?php

/**
 *
 */
class DatabaseManager extends User implements IVisitor
{
    private $staff_id;

    public function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->u_type = "db_manager";
        $this->staff_id = $attributeArray['staff_id'];
    }

    public function add_user($table, $div, $staff_id, $u_object)
    {
        $is_success = $this->db->create_user_account($staff_id, $u_object);
        if ($is_success && !empty($table))
            $this->db->assign_staff_details($table, $div, $staff_id);

    }

    public function remove_L_P_User($table, $key, $key_value)
    {
        $this->db->delete_row($table, $key, $key_value);
        $this->clearL_P_UserTraces($key, $key_value);

    }

    public function clearL_P_UserTraces($key, $key_value)
    {
        $this->db->delete_traces('gn', 'staff_id', 0, $key, $key_value);
        $this->db->delete_traces('ds', 'staff_id', 0, $key, $key_value);
        $this->db->delete_traces('schools', 'staff_id', 0, $key, $key_value);
        $this->db->delete_traces('estates', 'staff_id', 0, $key, $key_value);
    }

    /**
     * @throws Exception
     */
    public function getGnDivOrAddress()
    {
        throw new Exception("No divisions for Database Manager");
    }

    /**
     * @return void
     * @throws Exception
     */
    public function getDs()
    {
        throw new Exception("No divisions for Database Manager");
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }

    function visitApplication($application)
    {
        return $application->getApplicationDetails();
    }

    function visitNotification($notification)
    {
        return $notification->getNotificationDetails();
    }

    function visitNIC($nic)
    {
        return $nic->getNicDetails();
    }

    public function getNextStaffId(): int
    {
        return ($this->db->get_column_value("user_details", "staff_id", ">", "0", "staff_id", "ORDER BY staff_id DESC") ?? 0) + 1;
    }

    public function fetchGnCode($div, $div2)
    {
        $ds_id = $this->db->get_column_value('ds', 'DS', '=', $div2, 'DS_code', '');
        return $this->db->get_column_value2('gn', 'basic_division', 'DS_code', $div, $ds_id, 'division_id');
    }

    public function getAutoloadArray($table, $column, $value)
    {
        return $this->db->get_table_info($table, $column, $value);
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


