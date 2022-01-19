<?php

abstract class R_A_P extends L_P_User implements IApprover, IVisitor
{
    private $staff_id;

    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->staff_id = $attributeArray['staff_id'];
    }

//    public function send_time_slots()
//    {
//        // code...
//    }

    public function approve_application($application,$notification)
    {
        $application->approve($this,$notification);
        $this->db->save_state_of_application($application);

    }
    public function reject_application($application,$notification){
        $application->reject($this,$notification);
        $this->db->save_state_of_application($application);
        $this->db->remove_application('app_id', $application->getRowId());
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