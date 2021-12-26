<?php

abstract class State
{
    protected $state;
    public abstract function approve($utype, $application);
    public abstract function reject($utype, $application);
    public abstract function getState();
}

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


    public function approve($utype, $application)
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

    public function approve($utype, $application)
    {
        if($utype == "gn"){
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
            self::$sent_to_ds == new Sent_To_DS();
        return self::$sent_to_ds;
    }


    public function approve($utype, $application)
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
    public function approve($utype, $application)
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

    public function approve($utype, $application)
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
