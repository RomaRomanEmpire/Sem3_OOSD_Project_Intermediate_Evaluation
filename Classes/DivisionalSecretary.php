<?php
/**
 *
 */
class DivisionalSecretary extends R_A_P
{

  public function __construct($attributeArray)
  {
      parent::__construct($attributeArray);
      $this->db = DB_OP::get_connection();
      $this->u_type = "ds";
  }

  public function approve_application($application)
  {
    $db->approve_application($application_id,"level 2");
  }
}

?>
