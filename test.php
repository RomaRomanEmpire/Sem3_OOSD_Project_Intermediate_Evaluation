<?php
$array = array("Volvo", "BMW", "Toyota");
foreach ($array as $i => $person):
    echo $person;
endforeach;

session_start();
echo $_SESSION['fuck'];