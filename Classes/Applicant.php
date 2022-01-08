<?php
/**
 *
 */
class Applicant extends L_P_User implements IApprover,IVisitor
{
  protected $gender;
  protected $bday;
  protected $address;
  private $application;

  public function __construct($attributeArray)
  {

    parent::__construct($attributeArray);
    $this->address = $attributeArray["Address"];
    $this->gender = $attributeArray["gender"];
    $this->bday = $attributeArray["Birthday"];
    $this->u_type = "applicant";
    $this->application = new Application();
  }


  public function apply_NIC($stat,$gn_div_or_address,$ds,$table,$application_object)
  {
    $this->db->add_application($this->row_id,$stat,$gn_div_or_address,$ds,$table,$application_object);
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
   * @return Application
   */
  public function getApplication()
  {
    return $this->application;
  }


  public function visitApplication($application)
  {
    // TODO: Implement visitApplication() method.
  }

  public function visitNotification($notification)
  {
    // TODO: Implement visitNotification() method.
  }
}


?>
