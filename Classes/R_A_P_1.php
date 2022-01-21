<?php
/**
 *
 */
abstract class R_A_P_1 extends R_A_P
{
    protected $gn_div_or_address;
    function __construct($attributeArray)
    {
        parent::__construct($attributeArray);
    }

    public function send_time_slot($notification)
    {
        $this->send_notification($notification,"");
    }

    public function add_applicant_sign($application,$file){
        $application->setApplicantSign($file);
        echo "<script type='text/javascript'>alert('Sign1 set before stat saved ');</script>";
        $this->db->save_state_of_application($application);
        echo "<script type='text/javascript'>alert('Sign1 set after stat saved ');</script>";
    }





  
}

?>
