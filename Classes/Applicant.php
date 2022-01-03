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
  private $application_id;

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
    $this->setApplicationId($this->db->add_application($this->row_id,$stat,$gn_div_or_address,$ds,$application_object));
  }

  public function select_time_slot()
  {
    // code..
  }

  /**
   * @return void
   * @throws Exception
   */
  public function getGnDivOrAddress()
  {
    throw new Exception("Applicants not categorized in divisions");
  }

  /**
   * @return void
   * @throws Exception
   */
  public function getDs()
  {
    throw new Exception("Applicants not categorized in divisions");
  }

  /**
   * @return mixed
   */
  public function getApplicationId()
  {
    return $this->application_id;
  }

  /**
   * @param mixed $application_id
   */
  public function setApplicationId($application_id): void
  {
    $this->application_id = $application_id;
  }


}


?>
