<?php

interface IVisitor
{
    function visitApplication($application);

    function visitNotification($notification);
}