<?php

interface IVisitor
{
    function visitApplication($application);

    function visitNotification($notification);

    function visitNIC($nic);
}