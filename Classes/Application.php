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
    }

    /**
     * @param $photographs
     * @param $receipt
     * @param $attributeArray
     * @param $applicant
     * @param $app_type_id
     */
    public function setDetails($photographs, $receipt, $policeReport, $attributeArray, $applicant, $app_type_id)
    {
        $this->setState(Unfilled::getUnfilled());
        $this->application_details = array();
        $this->Iapprovers = array();

        $this->application_details = $attributeArray;

        $this->application_details['app_type_id'] = $app_type_id;
        //for lost id
        $this->application_details['policeReport'] = $policeReport ?? NULL;

        $this->application_details['photograph'] = $photographs;
        $this->application_details['receipt'] = $receipt;


        $this->setApplyDate();
        $this->approve($applicant, new Notification('', ''));
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
    public function setApprovedDate()
    {
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
