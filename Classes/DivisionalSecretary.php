<?php
/**
 *
 */
class DivisionalSecretary extends R_A_P
{

  public function __construct($attributeArray)
  {
      super($attributeArray);
      $db = DB_OP::get_connection();
      $u_type = "ds";
  }

	public function approve_application($application_id)
	{
		$db->approve_application($application_id,"ds_level");
	}

  public function approve_application($application)
  {
    $db->approve_application($application_id,"level 2");
  }
}

?>
