<?php
/**
 *
 */
class Notification implements IVisitable
{

  function __construct($argument)
  {

  }

    function accept($visitor)
    {
        $visitor.visit($this);
    }
}

 ?>
