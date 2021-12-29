<?php
abstract class State
{
    protected $state;
    public abstract function approve($utype, $application);
    public abstract function reject($utype, $application);
    public abstract function getState();
}
