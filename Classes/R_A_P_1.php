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

    public function add_applicant_sign($application){
        $this->db->add_sign_to_application($application->getRowId(), $application);
    }

  
}

?>
