<?php
// include 'autoloader.php';
/**
 *
 */
class Applicant extends L_P_User implements Approvable
{
  protected $gender;
  protected $bday;
  protected $address;

  public function __construct($attributeArray)
  {

    parent::__construct($attributeArray);

    $this->address = $attributeArray["Address"];
    $this->gender = $attributeArray["gender"];
    $this->bday = $attributeArray["Birthday"];
    $this->u_type = "applicant";
  }


  public function apply_NIC($stat,$gn_div_or_address,$ds,$application_object)
  {
    $this->db->add_application($this->row_id,$stat,$gn_div_or_address,$ds,$application_object);
  }

  public function select_time_slot()
  {
    // code..
  }

}


?>
