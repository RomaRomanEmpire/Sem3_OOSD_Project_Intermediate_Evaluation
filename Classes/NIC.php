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
    public function __construct($attributeArray )
    {
        $this->nic_details=array();
        $this->nic_details['fullname'] = $attributeArray['familyName'] . ' ' . $attributeArray['name'] . ' ' . $attributeArray['surname'];
        $this->nic_details['photograph'] = $attributeArray['photograph']; 
        $this->nic_details['gender'] = $attributeArray['gender'];
        $this->nic_details['birthday'] = $attributeArray['birthday'];
        $this->nic_details['bPlace'] = $attributeArray['placeOfBirth'] ?? $attributeArray['birthCity'] . ', ' . $attributeArray['countryOfBirth'];
        $this->nic_details['address'] = $attributeArray['permHouseName'] . ', ' . $attributeArray['permRoad'] . ', ' . $attributeArray['permVillage'];
        $this->nic_details['job'] =$attributeArray['profession'];
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