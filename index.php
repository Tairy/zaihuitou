<?php

function __autoload($classname){
	require_once($classname."Class.php");
}

$message = new MessageReceive();
$message -> main();
?>