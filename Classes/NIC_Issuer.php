<?php

/**
 *
 */
class NIC_Issuer extends L_P_User implements Approvable
{

  function __construct($attributeArray)
  {
    parent::__construct($attributeArray);
    $this->u_type = "ni";
  }

  public function fetch_NIC_details($value='')
  {
    // code...
  }
  public function issue_NIC($value='')
  {
    // code...
  }
}

 ?>
