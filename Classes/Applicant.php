<?php
// include 'autoloader.php';
/**
 *
 */
class Applicant extends L_P_User implements Approvable
{

  public function __construct($attributeArray)
  {

    super($attributeArray);
    $this->address = $attributeArray["Address"];
    $this->gender = $attributeArray["gender"];
    $this->bday = $attributeArray["Birthday"];

    $this->u_type = "applicant";
    $db = DB_OP::get_connection();
  }


  public function reqest_type(){

  }

  public function apply_NIC($gn_div_or_address,$ds,$application_object)
  {
    if(!isset($row_id)){
      $this->get_row_id();
    }
    $db->add_application($row_id,$gn_div_or_address,$ds,$application_object);
  }

  public function set_row_id($row_id)
  {
    $this->row_id = $row_id;
  }

  public function get_row_id()
  {
    $row_id = $db->get_column_value("user_details","username","=",$uname,"user_id","");
  }
  public function select_time_slot()
  {
    // code..
  }

}


?>
