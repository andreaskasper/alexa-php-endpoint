<?php

namespace Alexa\Endpoint;

class Request {
	
	public $raw = array();

	public function __construct() {
		$str = file_get_contents('php://input');
		if ($str."" == "") throw new Exception("Vermutlich keine Alexa Anfrage");
		$this->raw = json_decode($str,true);
		@file_put_contents("test.log", var_export($this->raw,true), FILE_APPEND);
	}
	
	public function intent_name() {
		return $this->raw["request"]["intent"]["name"];
	}
	
	public function sessiondata($key) {
		if (!isset($this->raw["session"]["attributes"][$key])) return null;
		return $this->raw["session"]["attributes"][$key];
	}
	
	
}