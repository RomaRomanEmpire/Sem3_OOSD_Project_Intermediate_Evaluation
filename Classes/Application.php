<?php



class Application implements IVisitable
{
    private $gn_div_or_address;
    private $ds;

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

    private array $approvers;
    private $state;
    private $app_type_id;

    private $applicant_sign;
    private $rap_sign;
    private $ds_sign;
    private $certifyName2;

    private $apply_date;
    private $row_id;

    public function __construct()
    {
        $this->state = Unfilled::getUnfilled();
    }

    public function setDetails($photographs, $receipt, $attributeArray, $applicant, $app_type_id)
    {

        $this->familyName = $attributeArray['familyName'] ?? NULL;
        $this->name = $attributeArray['name'] ?? NULL;
        $this->surname = $attributeArray['surname'] ?? NULL;
        $this->gender = $attributeArray['gender'] ?? NULL;
        $this->civilStatus = $attributeArray['civilStatus'] ?? NULL;
        $this->profession = $attributeArray['profession'] ?? NULL;
        $this->birthday = $attributeArray['birthday'] ?? NULL;
        $this->birthCertificateNo = $attributeArray['birthCertificateNo'] ?? NULL;
        $this->placeOfBirth = $attributeArray['placeOfBirth'] ?? NULL;
        $this->birthDivision = $attributeArray['birthDivision'] ?? NULL;
        $this->birthDistrict = $attributeArray['birthDistrict'] ?? NULL;
        $this->countryOfBirth = $attributeArray['countryOfBirth'] ?? NULL;
        $this->birthCity = $attributeArray['birthCity'] ?? NULL;

        $this->citizenshipCertificateNo = $attributeArray['citizenshipCertificateNo'] ?? NULL;
        $this->permHouseName = $attributeArray['permHouseName'] ?? NULL;
        $this->permRoad = $attributeArray['permRoad'] ?? NULL;
        $this->permVillage = $attributeArray['permVillage'] ?? NULL;
        $this->permPostalCode = $attributeArray['permPostalCode'] ?? NULL;
        $this->postalHouseName = $attributeArray['postalHouseName'] ?? NULL;
        $this->postalRoad = $attributeArray['postalRoad'] ?? NULL;
        $this->postalVillage = $attributeArray['postalVillage'] ?? NULL;
        $this->postalPostalCode = $attributeArray['postalPostalCode'] ?? NULL;
        $this->citizenshipCertificateType = $attributeArray['citizenshipCertificateType'] ?? NULL;
        $this->citizenshipCertificateNo_9_1 = $attributeArray['certificateNo_9.1'] ?? NULL;
        $this->citizenshipCertificateDate = $attributeArray['citizenshipCertificateDate'] ?? NULL;
        $this->residenceTelNo = $attributeArray['residenceTelNo'] ?? NULL;
        $this->mobileTelNo = $attributeArray['mobileTelNo'] ?? NULL;
        $this->email = $attributeArray['email'] ?? NULL;
        $this->purpose = $attributeArray['purpose'] ?? NULL;
        $this->lostIdNum = $attributeArray['lostIdNum'] ?? NULL;
        $this->lostIdDate = $attributeArray['lostIdDate'] ?? NULL;
        $this->policeStationName = $attributeArray['policeStationName'] ?? NULL;
        $this->policeReportDate = $attributeArray['policeReportDate'] ?? NULL;
        $this->photographs = $photographs ?? NULL;
        $this->receiptNo = $attributeArray['receiptNo'] ?? NULL;
        $this->receipt = $receipt ?? NULL;

        $this->approvers = array();

        $this->setApplyDate();

        $this->app_type_id = $app_type_id;

        $this->approve($applicant, new Notification('',''));
        $this->fillApprovableArray($applicant);

    }
    public function setCertificationDetails($para_1,$para_2,$certifyName){
        $this->para_1 = $para_1;
        $this->para_2 = $para_2;
        $this->certifyName = $certifyName;
    }

    public function setCertificationDetails2($certifyName2){
        $this->certifyName2 = $certifyName2;
    }

    /**
     * @return mixed
     */
    public function getCertifyName2()
    {
        return $this->certifyName2;
    }

    /**
     * @return mixed
     */
    public function getRowId()
    {
        return $this->row_id;
    }

    /**
     * @param mixed $row_id
     */
    public function setRowId($row_id): void
    {
        $this->row_id = $row_id;
    }

    /**
     * @return mixed
     */
    public function getGnDivOrAddress()
    {
        return $this->gn_div_or_address;
    }

    /**
     * @param mixed $gn_div_or_address
     */
    public function setGnDivOrAddress($gn_div_or_address): void
    {
        $this->gn_div_or_address = $gn_div_or_address;
    }

    /**
     * @return mixed
     */
    public function getDs()
    {
        return $this->ds;
    }

    /**
     * @param mixed $ds
     */
    public function setDs($ds): void
    {
        $this->ds = $ds;
    }



    public function setApplyDate()
    {
        date_default_timezone_set('Asia/Colombo');
        $this->apply_date = date('Y/m/d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getApplyDate()
    {
        return $this->apply_date;
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


    public function fillApprovableArray($user)
    {
        array_push($this->approvers, $user);
    }

    /**
     * @return mixed
     */
    public function getApplicantSign()
    {
        return $this->applicant_sign;
    }

    /**
     * @param mixed $applicant_sign
     */
    public function setApplicantSign($applicant_sign): void
    {
        $this->applicant_sign = $applicant_sign;
    }

    /**
     * @return mixed
     */
    public function getRapSign()
    {
        return $this->rap_sign;
    }

    /**
     * @param mixed $rap_sign
     */
    public function setRapSign($rap_sign): void
    {
        $this->rap_sign = $rap_sign;
    }

    /**
     * @return mixed
     */
    public function getDsSign()
    {
        return $this->ds_sign;
    }

    /**
     * @param mixed $ds_sign
     */
    public function setDsSign($ds_sign): void
    {
        $this->ds_sign = $ds_sign;
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

    public function approve($user, $notification)
    {
        $this->notifyIApprovers($user,$notification);
        $this->fillApprovableArray($user);
        $this->state->approve($user->get_user_type(), $this);
    }

    /**
     * @throws Exception
     */
    public function reject($user, $notification)
    {
        $this->notifyIApprovers($user, $notification);
        $this->state->reject($user->get_user_type(), $this);
    }

    private function notifyIApprovers($user,$notification){

        foreach ($this->approvers as $approver):
            $notification->setFromId($user->getRowId());
            $notification->setToId($approver->getRowId());
            $notification->setApplicationId($this->getRowId());

            $user->send_notification($notification);
            endforeach;
    }
}