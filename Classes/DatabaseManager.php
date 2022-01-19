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

    public function remove_L_P_User($user_id)
    {
        $this->db->remove_data("user_details", "user_id", $user_id);
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


    function visitApplication($application)
    {
        return $application->getApplicationDetails();
    }

    function visitNotification($notification)
    {
        return $notification->getNotificationDetails();
    }
}


