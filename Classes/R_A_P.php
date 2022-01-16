<?php

abstract class R_A_P extends L_P_User implements IApprover, IVisitor
{
    private $staff_id;

    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
        $this->staff_id = $attributeArray['staff_id'];
    }

//    public function view_application()
//    {
//        // code...
//    }
//
//    public function send_time_slots()
//    {
//        // code...
//    }

    public function approve_application($application,$notification)
    {
        $application->approve($this,$notification);
        $this->db->save_state_of_application($application->getRowId(), $application);

    }
    public function reject_application($application,$notification){
        $application->reject($this,$notification);
        $this->db->save_state_of_application($application->getRowId(), $application);
        $this->db->delete_application();
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