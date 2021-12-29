<?php
class Approved extends State
{
    private static $approved;

    private function __construct()
    {
        $this->state = "approved";
    }

    /**
     * @return mixed
     */
    public static function getApproved()
    {
        if (self::$approved == null)
            self::$approved = new Approved();
        return self::$approved;
    }

    /**
     * @throws Exception
     */
    public function approve($utype, $application)
    {
        throw new Exception("No Approved state from Approved State");
    }

    /**
     * @throws Exception
     */
    public function reject($utype, $application)
    {
        throw new Exception("No Cancelled state from Approved State");
    }
    public function getState()
    {
        return $this->state;
    }
}