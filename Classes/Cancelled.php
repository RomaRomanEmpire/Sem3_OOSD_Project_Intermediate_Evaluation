<?php
class Cancelled extends State
{
    private static $cancelled;

    private function __construct()
    {
        $this->state = "cancelled";
    }

    /**
     * @return mixed
     */
    public static function getCancelled()
    {
        if (self::$cancelled == null)
            self::$cancelled = new Cancelled();
        return self::$cancelled;
    }

    /**
     * @throws Exception
     */
    public function approve($u_type, $application)
    {
        throw new Exception("No Approved state from Cancelled State");
    }

    /**
     * @throws Exception
     */
    public function reject($utype, $application)
    {
        throw new Exception("No Cancelled state from Cancelled State");
    }
    public function getState()
    {
        return $this->state;
    }
}