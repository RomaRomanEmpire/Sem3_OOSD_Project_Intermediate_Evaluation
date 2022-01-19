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
  public function getApplication(): Application
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

  public function fetch_object($table, $key, $key_value, $object){
    return $this->db->get_column_value($table, $key, '=', $key_value, $object, "");
  }

  public function fetch_array($table, $key, $key_value,$order){
    return $this->db->database_details($table,$key, $key_value, $order);
  }

  public function fetch_array_2($table, $key1, $key2, $key_value1, $key_value2,$order){
    return $this->db->database_details_2($table, $key1, $key2, '=', '=', $key_value1, $key_value2, $order);
  }

  public function updateNotificationDetails($notification){
    $this->db->save_state_of_notification($notification);
  }

  public function isAlreadyApplied($user_id): bool
  {
    return $this->db->get_column_value("application_details", "applicant_id", "=", $user_id, "app_id", "") !== null;
  }
}



