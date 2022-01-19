<?php

/**
 *
 */
class NIC
{
    private $fullname;
    private $photograph;
    private $gender;
    private $birthday;
    private $bPlace;
    private $address;
    private $job;
    private $issuedDate;

    /**
     * @param $attributeArray
     */
    public function __construct($attributeArray)
    {
        $this->fullname = $attributeArray['fullname'];
        $this->photograph = $attributeArray['photograph'];
        $this->gender = $attributeArray['gender'];
        $this->birthday =$attributeArray['birthday'];
        $this->bPlace = $attributeArray['bPlace'];
        $this->address = $attributeArray['address'];
        $this->job = $attributeArray['job'];
    }
    public function setIssuedDate(){
        date_default_timezone_set('Asia/Colombo');
        $this->issuedDate = date('Y/m/d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getIssuedDate()
    {
        return $this->issuedDate;
    }


}