<?php
/**
 *
 */
abstract class R_A_P extends L_P_User implements Approvable
{
  protected $u_type;
  
  public function view_application()
  {
    // code...
  }
  public function send_time_slots()
  {
    // code...
  }
  public abstract function approve_application();
  

}

 ?>
