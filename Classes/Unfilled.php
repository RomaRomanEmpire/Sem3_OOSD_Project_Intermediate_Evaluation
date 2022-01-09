<?php
class Unfilled extends State
{

    private static $unfilled;

    private function __construct()
    {
        $this->state = "unfilled";
    }

    /**
     * @return mixed
     */
    public static function getUnfilled()
    {
        if (self::$unfilled == null)
            self::$unfilled = new Unfilled();
        return self::$unfilled;
    }


    public function approve($u_type, $application)
    {
        $application->setState(Sent_To_RAP_1::getSentToRap1());

    }

    /**
     * @throws Exception
     */
    public function reject($utype, $application)
    {
        throw new Exception("No Reject state from Unfilled State");
    }

    public function getState()
    {
        return $this->state;
    }
}