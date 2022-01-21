<?php

/**
 *
 */
class NIC implements IVisitable
{
    private array $nic_details;

    private $issuedDate;

    /**
     * @param $attributeArray
     */
    public function __construct($attributeArray)
    {
        $this->nic_details=array();
        $this->nic_details['fullname'] = $attributeArray['fullname'];
        $this->nic_details['photograph'] = $attributeArray['photograph'];
        $this->nic_details['gender'] = $attributeArray['gender'];
        $this->nic_details['birthday'] =$attributeArray['birthday'];
        $this->nic_details['bPlace'] = $attributeArray['bPlace'];
        $this->nic_details['address'] = $attributeArray['address'];
        $this->nic_details['job'] = $attributeArray['job'];
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

    /**
     * @return array
     */
    public function getNicDetails(): array
    {
        return $this->nic_details;
    }


    function accept($visitor)
    {
        return $visitor->visitNIC($this);
    }
}