<?php


class Application implements IVisitable
{
    private $gn_div_or_address;
    private $ds;

    private array $application_details;

    private array $Iapprovers;
    private State $state;

    private $apply_date;
    private $row_id;

    public function __construct()
    {
        $this->setState(Unfilled::getUnfilled());
        $this->application_details = array();
    }

    /**
     * @param $photographs
     * @param $receipt
     * @param $attributeArray
     * @param $applicant
     * @param $app_type_id
     */
    public function setDetails($photographs, $receipt, $attributeArray, $applicant, $app_type_id)
    {
        $this->application_details = $attributeArray;
        $this->application_details['familyName'] = $attributeArray['familyName'] ?? NULL;
        $this->application_details['surname'] = $attributeArray['surname'] ?? NULL;
        $this->application_details['birthCertificateNo'] = $attributeArray['birthCertificateNo'] ?? NULL;
        $this->application_details['placeOfBirth'] = $attributeArray['placeOfBirth'] ?? NULL;
        $this->application_details['birthDivision'] = $attributeArray['birthDivision'] ?? NULL;
        $this->application_details['birthDistrict'] = $attributeArray['birthDistrict'] ?? NULL;
        $this->application_details['countryOfBirth'] = $attributeArray['countryOfBirth'] ?? NULL;
        $this->application_details['birthCity'] = $attributeArray['birthCity'] ?? NULL;
        $this->application_details['citizenshipCertificateNo'] = $attributeArray['citizenshipCertificateNo'] ?? NULL;
        $this->application_details['citizenshipCertificateType'] = $attributeArray['citizenshipCertificateType'] ?? NULL;

        $this->application_details['certificateNo_9'] = $attributeArray['certificateNo_9'] ?? NULL;
        $this->application_details['citizenshipCertificateDate'] = $attributeArray['citizenshipCertificateDate'] ?? NULL;
        $this->application_details['residenceTelNo'] = $attributeArray['residenceTelNo'] ?? NULL;
        $this->application_details['mobileTelNo'] = $attributeArray['mobileTelNo'] ?? NULL;
        $this->application_details['email'] = $attributeArray['email'] ?? NULL;
        $this->application_details['app_type_id'] = $app_type_id;
        //for lost id
        $this->application_details['purpose'] = $attributeArray['purpose'] ?? NULL;
        $this->application_details['lostIdNum'] = $attributeArray['lostIdNum'] ?? NULL;
        $this->application_details['lostIdDate'] = $attributeArray['lostIdDate'] ?? NULL;
        $this->application_details['policeStationName'] = $attributeArray['policeStationName'] ?? NULL;
        $this->application_details['policeReportDate'] = $attributeArray['policeReportDate'] ?? NULL;


        $this->application_details['photograph'] = $photographs;
        $this->application_details['receipt'] = $receipt;

        $this->Iapprovers = array();
        $this->setApplyDate();
        $this->approve($applicant, new Notification('', ''));
        $this->fillIApprovableArray($applicant);

    }

    /**
     * @param $para_1
     * @param $para_2
     * @param $certifyName
     */
    public function setCertificationDetails($para_1, $para_2, $certifyName)
    {
        $this->application_details['para_1'] = $para_1;
        $this->application_details['para_2'] = $para_2;
        $this->application_details['certifyName'] = $certifyName;
    }

    /**
     * @param $certifyName2
     */
    public function setCertificationDetails2($certifyName2)
    {
        $this->application_details['certifyName2'] = $certifyName2;
    }

    /**
     * @param mixed $applicant_sign
     */
    public function setApplicantSign($applicant_sign): void
    {
        $this->application_details['applicant_sign'] = $applicant_sign;

    }

    /**
     * @param mixed $rap_sign
     */
    public function setRapSign($rap_sign): void
    {
        $this->application_details['rap_sign'] = $rap_sign;
    }

    /**
     * @param mixed $ds_sign
     */
    public function setDsSign($ds_sign): void
    {
        $this->application_details['ds_sign'] = $ds_sign;
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
    public function getRowId()
    {
        return $this->row_id;
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
    public function getGnDivOrAddress()
    {
        return $this->gn_div_or_address;
    }

    /**
     * @param mixed $ds
     */
    public function setDs($ds): void
    {
        $this->ds = $ds;
    }

    /**
     * @return mixed
     */
    public function getDs()
    {
        return $this->ds;
    }

    /**
     *
     */
    public function setApprovedDate(){
        date_default_timezone_set('Asia/Colombo');
        $this->application_details['approved_date'] = date('Y/m/d H:i:s');
    }

    /**
     *
     */
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
     * @param mixed
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param $user
     */
    public function fillIApprovableArray($user)
    {
        array_push($this->Iapprovers, $user);
    }


    /**
     * @return array
     */
    public function getIApprovers(): array
    {
        return $this->Iapprovers;
    }

    /**
     * @param $visitor
     * @return mixed
     */
    public function accept($visitor)
    {
        return $visitor->visitApplication($this);
    }

    /**
     * @return array
     */
    public function getApplicationDetails(): array
    {
        return $this->application_details;
    }

    /**
     * @param $user
     * @param $notification
     */
    public function approve($user, $notification)
    {
        $this->notifyIApprovers($user, $notification);
        $this->fillIApprovableArray($user);
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

    /**
     * @param $user
     * @param $notification
     */
    private function notifyIApprovers($user, $notification)
    {

        foreach ($this->getIApprovers() as $approver):
            $notification->setFromId($user->getRowId());
            $notification->setToId($approver->getRowId());
            $notification->setApplicationId($this->getRowId());

            $user->send_notification($notification);
        endforeach;
    }
}
