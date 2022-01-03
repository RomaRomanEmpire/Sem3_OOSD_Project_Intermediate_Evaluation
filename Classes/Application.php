<?php

/**
 *
 */
class Application
{
    private $familyName;
    private $name;
    private $surname;
    private $gender;
    private $civilStatus;
    private $profession;
    private $birthday;
    private $birthCertificateNo;
    private $placeOfBirth;
    private $birthDivision;
    private $birthDistrict;
    private $countryOfBirth;
    private $birthCity;
    private $citizenshipCertificateNo;
    private $permHouseName;
    private $permRoad;
    private $permVillage;
    private $permPostalCode;
    private $postalHouseName;
    private $postalRoad;
    private $postalVillage;
    private $postalPostalCode;
    private $citizenshipCertificateType;
    private $citizenshipCertificateNo_9_1;
    private $citizenshipCertificateDate;
    private $residenceTelNo;
    private $mobileTelNo;
    private $email;
    private $purpose;
    private $lostIdNum;
    private $lostIdDate;
    private $policeStationName;
    private $policeReportDate;
    private $photographs;
    private $receiptNo;
    private $receipt;
    private $para_1;
    private $para_2;
    private $certifyName;

    private $approvableArray;
    private $state;
    private $app_type_id;

    // private $
    public function __construct($photographs,$receipt,$attributeArray, $applicant_id, $app_type_id)
    {

        $this->familyName = $attributeArray['familyName'];
        $this->name = $attributeArray['name'];
        $this->surname = $attributeArray['surname'];
        $this->gender = $attributeArray['gender'];
        $this->civilStatus = $attributeArray['civilStatus'];
        $this->profession = $attributeArray['profession'];
        $this->birthday = $attributeArray['birthday'];
        $this->birthCertificateNo = $attributeArray['birthCertificateNo'];
        $this->placeOfBirth = $attributeArray['placeOfBirth'];
        $this->birthDivision = $attributeArray['birthDivision'];
        $this->birthDistrict = $attributeArray['birthDistrict'];
        $this->countryOfBirth = $attributeArray['countryOfBirth'];
        $this->birthCity = $attributeArray['birthCity'];

        $this->citizenshipCertificateNo = $attributeArray['citizenshipCertificateNo'] ?? NULL;
        $this->permHouseName = $attributeArray['permHouseName'];
        $this->permRoad = $attributeArray['permRoad'];
        $this->permVillage = $attributeArray['permVillage'];
        $this->permPostalCode = $attributeArray['permPostalCode'];
        $this->postalHouseName = $attributeArray['postalHouseName'];
        $this->postalRoad = $attributeArray['postalRoad'];
        $this->postalVillage = $attributeArray['postalVillage'];
        $this->postalPostalCode = $attributeArray['postalPostalCode'];
        $this->citizenshipCertificateType = $attributeArray['citizenshipCertificateType'];
        $this->citizenshipCertificateNo_9_1 = $attributeArray['certificateNo_9.1']??NULL;
        $this->citizenshipCertificateDate = $attributeArray['citizenshipCertificateDate']??NULL;
        $this->residenceTelNo = $attributeArray['residenceTelNo'];
        $this->mobileTelNo = $attributeArray['mobileTelNo'];
        $this->email = $attributeArray['email'];
        $this->purpose = isset($attributeArray['purpose']) ? $attributeArray['purpose'] : NULL;
        $this->lostIdNum = isset($attributeArray['lostIdNum']) ? $attributeArray['lostIdNum'] : NULL;
        $this->lostIdDate = isset($attributeArray['lostIdDate']) ? $attributeArray['lostIdDate'] : NULL;
        $this->policeStationName = isset($attributeArray['policeStationName']) ? $attributeArray['policeStationName'] : NULL;
        $this->policeReportDate = isset($attributeArray['policeReportDate']) ? $attributeArray['policeReportDate'] : NULL;
        $this->photographs = $photographs;
        $this->receiptNo = $attributeArray['receiptNo'];
        $this->receipt = $receipt??NULL;
        $this->para_1 = $attributeArray['para_1'];
        $this->para_2 = $attributeArray['para_2'];
        $this->certifyName = $attributeArray['certifyName'];
        $this->approvableArray = array();
        $this->fillApprovableArray($applicant_id);

        $this->app_type_id = $app_type_id;
        $this->state = Unfilled::getUnfilled();
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param mixed|Unfilled $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }


    public function fillApprovableArray($user_id)
    {
        array_push($this->approvableArray, $user_id);
    }

    /**
     * @return mixed
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getCivilStatus()
    {
        return $this->civilStatus;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getBirthCertificateNo()
    {
        return $this->birthCertificateNo;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * @return mixed
     */
    public function getBirthDivision()
    {
        return $this->birthDivision;
    }

    /**
     * @return mixed
     */
    public function getBirthDistrict()
    {
        return $this->birthDistrict;
    }

    /**
     * @return mixed
     */
    public function getCountryOfBirth()
    {
        return $this->countryOfBirth;
    }

    /**
     * @return mixed
     */
    public function getBirthCity()
    {
        return $this->birthCity;
    }

    /**
     * @return mixed|null
     */
    public function getCitizenshipCertificateNo()
    {
        return $this->citizenshipCertificateNo;
    }

    /**
     * @return mixed
     */
    public function getPermHouseName()
    {
        return $this->permHouseName;
    }

    /**
     * @return mixed
     */
    public function getPermRoad()
    {
        return $this->permRoad;
    }

    /**
     * @return mixed
     */
    public function getPermVillage()
    {
        return $this->permVillage;
    }

    /**
     * @return mixed
     */
    public function getPermPostalCode()
    {
        return $this->permPostalCode;
    }

    /**
     * @return mixed
     */
    public function getPostalHouseName()
    {
        return $this->postalHouseName;
    }

    /**
     * @return mixed
     */
    public function getPostalRoad()
    {
        return $this->postalRoad;
    }

    /**
     * @return mixed
     */
    public function getPostalVillage()
    {
        return $this->postalVillage;
    }

    /**
     * @return mixed
     */
    public function getPostalPostalCode()
    {
        return $this->postalPostalCode;
    }

    /**
     * @return mixed
     */
    public function getCitizenshipCertificateType()
    {
        return $this->citizenshipCertificateType;
    }

    /**
     * @return mixed|null
     */
    public function getCitizenshipCertificateNo91()
    {
        return $this->citizenshipCertificateNo_9_1;
    }

    /**
     * @return mixed
     */
    public function getCitizenshipCertificateDate()
    {
        return $this->citizenshipCertificateDate;
    }

    /**
     * @return mixed
     */
    public function getResidenceTelNo()
    {
        return $this->residenceTelNo;
    }

    /**
     * @return mixed
     */
    public function getMobileTelNo()
    {
        return $this->mobileTelNo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed|null
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * @return mixed|null
     */
    public function getLostIdNum()
    {
        return $this->lostIdNum;
    }

    /**
     * @return mixed|null
     */
    public function getLostIdDate()
    {
        return $this->lostIdDate;
    }

    /**
     * @return mixed|null
     */
    public function getPoliceStationName()
    {
        return $this->policeStationName;
    }

    /**
     * @return mixed|null
     */
    public function getPoliceReportDate()
    {
        return $this->policeReportDate;
    }

    /**
     * @return mixed
     */
    public function getPhotographs()
    {
        return $this->photographs;
    }

    /**
     * @return mixed
     */
    public function getReceiptNo()
    {
        return $this->receiptNo;
    }

    /**
     * @return mixed
     */
    public function getReceipt()
    {
        return $this->receipt;
    }

    /**
     * @return mixed
     */
    public function getPara1()
    {
        return $this->para_1;
    }

    /**
     * @return mixed
     */
    public function getPara2()
    {
        return $this->para_2;
    }

    /**
     * @return mixed
     */
    public function getCertifyName()
    {
        return $this->certifyName;
    }

    /**
     * @return array
     */
    public function getApprovableArray(): array
    {
        return $this->approvableArray;
    }

    /**
     * @return mixed
     */
    public function getAppTypeId()
    {
        return $this->app_type_id;
    }


}


