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
    private $row_id;

    private array $notification_details;

    /**
     * @param $type
     * @param $content
     */
    public function __construct($type, $content)
    {
        $this->type = $type;
        $this->notification_details = array();
        $this->notification_details['content'] = $content;

        date_default_timezone_set('Asia/Colombo');

        $this->notification_details['send_date'] = date('Y/m/d H:i:s');
        $this->notification_details['has_reference_notification_id'] = false;
    }


    public function accept($visitor)
    {
        return $visitor->visitNotification($this);
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
     * @param mixed $to_id
     */
    public function setToId($to_id): void
    {
        $this->to_id = $to_id;
    }

    /**
     * @return mixed
     */
    public function getToId()
    {
        return $this->to_id;
    }

    /**
     * @param mixed $has_reference_notification_id
     */
    public function setHasReferenceNotificationId($has_reference_notification_id): void
    {
        $this->notification_details['has_reference_notification_id'] = $has_reference_notification_id;
    }

    /**
     * @param mixed $appointment_date
     */
    public function setAppointmentDate($appointment_date): void
    {
        $this->notification_details['appointment_date'] = $appointment_date;
    }

    /**
     * @param mixed $appointment_time
     */
    public function setAppointmentTime($appointment_time): void
    {
        $this->notification_details['appointment_time'] = $appointment_time;
    }

    public function setApplicantId($applicant_id){
        $this->notification_details['applicant_id'] = $applicant_id;
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
    public function getType()
    {
        return $this->type;
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
     * @param mixed $attachment
     */
    public function setAttachment($attachment): void
    {
        $this->notification_details['attachment'] = $attachment;
    }

    /**
     * @return array
     */
    public function getNotificationDetails(): array
    {
        return $this->notification_details;
    }
}