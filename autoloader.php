<?php
spl_autoload_register('autoloader');

function autoloader($classname)
{
	$path = "Classes/";
	$extension = ".php";
	$fullpath = $path.$classname.$extension;

	if(!file_exists($fullpath)){
		return false;
	}

	include_once $fullpath;
}

?>