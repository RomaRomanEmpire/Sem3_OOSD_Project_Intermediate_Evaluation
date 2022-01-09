<?php

class Sent_To_DS extends State
{
    private static $sent_to_ds;

    private function __construct()
    {
        $this->state = "sent_to_ds";
    }

    /**
     * @return mixed
     */
    public static function getSentToDs()
    {
        if (self::$sent_to_ds == null)
            self::$sent_to_ds = new Sent_To_DS();
        return self::$sent_to_ds;
    }


    public function approve($u_type, $application)
    {
        $application->setState(Sent_To_Admin::getSentToAdmin());
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