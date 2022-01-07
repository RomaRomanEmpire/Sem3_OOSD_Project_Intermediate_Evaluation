<?php

/**
 *
 */
class Application implements IVisitable
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

    private $approvers;
    private $state;
    private $app_type_id;

    // private $
    public function __construct()
    {
        $this->state = Unfilled::getUnfilled();
    }

    public function setDetails($photographs, $receipt, $attributeArray, $applicant_id, $app_type_id)
    {

        $this->familyName = $attributeArray['familyName']?? NULL;
        $this->name = $attributeArray['name']?? NULL;
        $this->surname = $attributeArray['surname']?? NULL;
        $this->gender = $attributeArray['gender']?? NULL;
        $this->civilStatus = $attributeArray['civilStatus']?? NULL;
        $this->profession = $attributeArray['profession']?? NULL;
        $this->birthday = $attributeArray['birthday']?? NULL;
        $this->birthCertificateNo = $attributeArray['birthCertificateNo']?? NULL;
        $this->placeOfBirth = $attributeArray['placeOfBirth']?? NULL;
        $this->birthDivision = $attributeArray['birthDivision']?? NULL;
        $this->birthDistrict = $attributeArray['birthDistrict']?? NULL;
        $this->countryOfBirth = $attributeArray['countryOfBirth']?? NULL;
        $this->birthCity = $attributeArray['birthCity']?? NULL;

        $this->citizenshipCertificateNo = $attributeArray['citizenshipCertificateNo'] ?? NULL;
        $this->permHouseName = $attributeArray['permHouseName']?? NULL;
        $this->permRoad = $attributeArray['permRoad']?? NULL;
        $this->permVillage = $attributeArray['permVillage']?? NULL;
        $this->permPostalCode = $attributeArray['permPostalCode']?? NULL;
        $this->postalHouseName = $attributeArray['postalHouseName']?? NULL;
        $this->postalRoad = $attributeArray['postalRoad']?? NULL;
        $this->postalVillage = $attributeArray['postalVillage']?? NULL;
        $this->postalPostalCode = $attributeArray['postalPostalCode']?? NULL;
        $this->citizenshipCertificateType = $attributeArray['citizenshipCertificateType']?? NULL;
        $this->citizenshipCertificateNo_9_1 = $attributeArray['certificateNo_9.1'] ?? NULL;
        $this->citizenshipCertificateDate = $attributeArray['citizenshipCertificateDate'] ?? NULL;
        $this->residenceTelNo = $attributeArray['residenceTelNo']?? NULL;
        $this->mobileTelNo = $attributeArray['mobileTelNo']?? NULL;
        $this->email = $attributeArray['email']?? NULL;
        $this->purpose = $attributeArray['purpose'] ?? NULL;
        $this->lostIdNum = $attributeArray['lostIdNum'] ?? NULL;
        $this->lostIdDate = $attributeArray['lostIdDate'] ?? NULL;
        $this->policeStationName = $attributeArray['policeStationName'] ?? NULL;
        $this->policeReportDate = $attributeArray['policeReportDate'] ?? NULL;
        $this->photographs = $photographs?? NULL;
        $this->receiptNo = $attributeArray['receiptNo']?? NULL;
        $this->receipt = $receipt ?? NULL;
        $this->para_1 = $attributeArray['para_1']?? NULL;
        $this->para_2 = $attributeArray['para_2']?? NULL;
        $this->certifyName = $attributeArray['certifyName']?? NULL;
        $this->approvers = array();
        $this->fillApprovableArray($applicant_id);

        $this->app_type_id = $app_type_id;

        $this->approve("applicant");

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
        array_push($this->approvers, $user_id);
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
    public function getApprovers(): array
    {
        return $this->approvers;
    }

    /**
     * @return mixed
     */
    public function getAppTypeId()
    {
        return $this->app_type_id;
    }


    public function accept($visitor)
    {
        $visitor->visit($this);
    }

    public function approve($u_type)
    {
        $this->state->approve($u_type,$this);
    }

    public function reject($u_type)
    {
        $this->state->reject($u_type,$this);
    }
}


