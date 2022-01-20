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
        $this->db->save_state_of_application($application);
    }





  
}

?>
