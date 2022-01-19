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


  public function apply_NIC($table,$application_object)
  {
    $this->db->add_application($this->row_id,$table,$application_object);
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


  public function getApplicationId()
  {
    return $this->db->get_column_value('application_details', 'applicant_id', '=', $this->getRowId(), 'app_id', "");
  }


  public function visitApplication($application)
  {
    return $application->getApplicationDetails();
  }

  public function visitNotification($notification)
  {
    return $notification->getNotificationDetails();
  }
}


?>
