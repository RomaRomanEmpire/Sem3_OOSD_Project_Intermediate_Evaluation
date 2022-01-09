<?php
abstract class State
{
    protected $state;
    public abstract function approve($u_type, $application);
    public abstract function reject($utype, $application);
    public abstract function getState();
}
