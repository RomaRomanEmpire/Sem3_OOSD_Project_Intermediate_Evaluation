<?php
class Sent_To_Admin extends State
{

    private static $sent_to_admin;

    private function __construct()
    {
        $this->state = "sent_to_admin";
    }

    /**
     * @return mixed
     */
    public static function getSentToAdmin()
    {
        if (self::$sent_to_admin == null)
            self::$sent_to_admin = new Sent_To_Admin();
        return self::$sent_to_admin;
    }

    public function approve($u_type, $application)
    {
        $application->setState(Approved::getApproved());
    }

    public function reject($utype, $application)
    {
        $application->setState(Cancelled::getCancelled());
    }
    public function getState()
    {
        return $this->state;
    }
}