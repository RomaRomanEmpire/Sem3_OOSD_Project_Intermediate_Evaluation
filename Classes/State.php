<?php
abstract class State
{
    protected $state;
    public abstract function approve($u_type, $application);
    public abstract function reject($u_type, $application);
    public abstract function getState();
}
