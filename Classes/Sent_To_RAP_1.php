<?php
class Sent_To_RAP_1 extends State
{
    private static $sent_to_rap_1;

    private function __construct()
    {
        $this->state = "sent_to_rap_1";
    }

    /**
     * @return mixed
     */
    public static function getSentToRap1()
    {
        if (self::$sent_to_rap_1 == null)
            self::$sent_to_rap_1 = new Sent_To_RAP_1();
        return self::$sent_to_rap_1;
    }

    public function approve($u_type, $application)
    {
        if($u_type == "gn"){
            $application->setState(Sent_To_DS::getSentToDs());
        }else
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