<?php
/*
 * This is a easy example for Alexa to say "Hello World!"
 */
 
require_once(__DIR__."/../src/Response.php");

$r = new \Alexa\Endpoint\Response();

$r->sayText("Hello World!");
$r->send();
