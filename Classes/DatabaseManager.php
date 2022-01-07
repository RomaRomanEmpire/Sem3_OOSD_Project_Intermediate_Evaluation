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
    }

    public function add_L_P_User($table, $staff_id, $u_type, $username, $email, $pwd, $u_object)
    {
        $this->db->create_staff_acc($staff_id, $u_type, $username, $email, $pwd, $u_object);
        if (!empty($table)) {
            $this->db->assign_staff_details($table, $u_object->getGnDivOrAddress(), $staff_id);
        }
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
        // TODO: Implement visitApplication() method.
    }

    function visitNotification($notification)
    {
        // TODO: Implement visitNotification() method.
    }
}

?>
