<?php

/**
 *
 */
class NIC_Issuer extends L_P_User implements Approvable
{
  
  // function __construct($fname,$uname,$address,$email,$mobile_no,$gender,$bday,$password)
  // {
  //   $this->fname = $fname;
  //   $this->uname = $uname;
  //   $this->address = $address;
  //   $this->email = $email;
  //   $this->mobile_no = $mobile_no;
  //   $this->gender = $gender;
  //   $this->bday = $bday;
  //   $this->password = $password;
  //   $u_type = "ni";
  // }

  function __construct($attributeArray)
  {
    $this->fname = $attributeArray['fname'];
    $this->uname = $attributeArray['uname'];
    // $this->address = $attributeArray['address'];
    $this->email = $attributeArray['email'];
    $this->mobile_no = $attributeArray['mobileNo'];
    // $this->gender = $attributeArray['gender'];
    // $this->bday = $attributeArray['bday'];
    $this->password = $attributeArray['password'];
    $u_type = "ni";
  }

  public function fetch_NIC_details($value='')
  {
    // code...
  }
  public function issue_NIC($value='')
  {
    // code...
  }

  public function get_user_type(){
    return $u_type;
  }
}

 ?>
