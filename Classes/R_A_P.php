<?php
/**
 *
 */
abstract class R_A_P extends L_P_User implements IApprover,IVisitor
{
  function __construct($attributeArray)
  {
     parent::__construct($attributeArray);
  }
  
  public function view_application()
  {
    // code...
  }
  public function send_time_slots()
  {
    // code...
  }
  public function approve_application($application)
  {
    $this->db->add_signs_to_application($application->getRowId(), $application);
    $application->approve($this);
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
