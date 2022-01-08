<?php

/**
 *
 */
abstract class User
{
    protected $fname;
    protected $uname;
    protected $email;
    protected $mobile_no;
    protected $password;

    protected $bday;
    protected $db;
    protected $row_id;
    protected $u_type;
    protected $gn_div_or_address;
    protected $ds;
    protected $pf_photo;

    function __construct($attributeArray)
    {
        $this->fname = $attributeArray['fname'];
        $this->uname = $attributeArray['uname'];
        $this->email = $attributeArray['email'];
        $this->mobile_no = $attributeArray['mobileNo'];
        $this->set_pwd($attributeArray['password']);

    }

    public function set_row_id($row_id)
    {
        $this->row_id = $row_id;
    }

    public function set_db($db)
    {
        $this->db = $db;
    }

    public function set_full_name($fname)
    {
        $this->fname = $fname;
    }

    public function set_user_name($uname)
    {
        $this->uname = $uname;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function set_mobile_no($mobile_no)
    {
        $this->mobile_no = $mobile_no;
    }

    public function set_bday($bday)
    {
        $this->bday = $bday;
    }

    /**
     * @param false|string|null $password
     */
    public function set_pwd($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    /**
     * @param mixed $pf_photo
     */
    public function setPfPhoto($pf_photo): void
    {
        $this->pf_photo = $pf_photo;
    }

    /**
     * @return mixed
     */
    public function getPfPhoto()
    {
        return $this->pf_photo;
    }

    public function get_user_type()
    {
        return $this->u_type;
    }

    public function get_full_name()
    {
        return $this->fname;
    }

    public function get_user_name()
    {
        return $this->uname;
    }

    public function get_user_email()
    {
        return $this->email;
    }

    public function get_mobile_no()
    {
        return $this->mobile_no;
    }

    public function get_user_pwd()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function get_bday()
    {
        return $this->bday;
    }

    public function update_fields($array,$pf)
    {
        if (isset($array['fname'])) $this->set_full_name($array['fname']);
        if (isset($array['uname'])) $this->set_user_name($array['uname']);
        if (isset($array['email'])) $this->set_email($array['email']);
        if (isset($array['mobile_no'])) $this->set_mobile_no($array['mobile_no']);
        if (isset($array['bday'])) $this->set_bday($array['bday']);
        if (isset($pf)) $this->setPfPhoto($pf);

        if (isset($array['new_pwd'])) {
            $this->set_pwd($array['new_pwd']);
            $this->db->update_user_account_details($this->row_id, $this->uname, $this->email, $this->get_user_pwd(), $this);
        } else
            $this->db->update_user_account_details($this->row_id, $this->uname, $this->email, NULL, $this);
    }

    /**
     * @return mixed
     */
    public abstract function getGnDivOrAddress();

    /**
     * @return mixed
     */
    public abstract function getDs();
}

