<?php
/**
 *
 */
class Notification implements IVisitable
{
    private $from_id;
    private $to_id;
    private $application_id;

    private $type;
    private $content;
    private $send_date;

    private $appointment_date;
    private $appointment_time;

    private $attachment;


    /**
     * @param $type
     * @param $content
     */
    public function __construct($type, $content)
    {
        $this->type = $type;
        $this->content = $content;
        $this->setSendDate();
    }


    function accept($visitor)
    {
        $visitor.visit($this);
    }

    /**
     * @param mixed $to_id
     */
    public function setToId($to_id): void
    {
        $this->to_id = $to_id;
    }

    /**
     * @return mixed
     */
    public function getSendDate()
    {
        return $this->send_date;
    }

    /**
     */
    public function setSendDate(): void
    {
        date_default_timezone_set('Asia/Colombo');
        $this->send_date = date('Y/m/d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getAppointmentDate()
    {
        return $this->appointment_date;
    }

    /**
     * @param mixed $appointment_date
     */
    public function setAppointmentDate($appointment_date): void
    {
        $this->appointment_date = $appointment_date;
    }

    /**
     * @return mixed
     */
    public function getAppointmentTime()
    {
        return $this->appointment_time;
    }

    /**
     * @param mixed $appointment_time
     */
    public function setAppointmentTime($appointment_time): void
    {
        $this->appointment_time = $appointment_time;
    }


    /**
     * @param mixed $from_id
     */
    public function setFromId($from_id): void
    {
        $this->from_id = $from_id;
    }

    /**
     * @return mixed
     */
    public function getFromId()
    {
        return $this->from_id;
    }

    /**
     * @return mixed
     */
    public function getToId()
    {
        return $this->to_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $application_id
     */
    public function setApplicationId($application_id): void
    {
        $this->application_id = $application_id;
    }



    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param mixed $attachment
     */
    public function setAttachment($attachment): void
    {
        $this->attachment = $attachment;
    }




}


