<?php

namespace Alexa\Endpoint;

class Request {
	
	public $raw = array();

	public function __construct() {
		$str = file_get_contents('php://input');
		if ($str."" == "") throw new \Exception("Vermutlich keine Alexa Anfrage");
		$this->raw = json_decode($str,true);
	}
	
	public function intent_name() {
		return $this->raw["request"]["intent"]["name"];
	}
	
	public function sessiondata($key) {
		if (!isset($this->raw["session"]["attributes"][$key])) return null;
		return $this->raw["session"]["attributes"][$key];
	}
	
	/**
	  * return the parameters of the request
	  *
	  * @param string $key The Key of the parameters
	  */
	public function slotdata($key) {
		if (!isset($this->raw["request"]["intent"]["slots"][$key]["value"])) return null;
		return $this->raw["request"]["intent"]["slots"][$key]["value"];
	}
	
	/**
	  * The language of the request in format de-DE, en-US,...
	  */
	public function lang() {
		return $this->raw["request"]["locale"];
	}
	
	/**
	  * The language of the request in format de, en,...
	  */
	public function lang2() {
		return strtolower(substr($this->lang(), 0, 2));
	}
	
	/**
	  * has the Echo a Display?
	  */
	public function hasDisplay() {
		if (!isset($this->raw["context"]["System"]["device"]["supportedInterfaces"]["Display"])) return false; //Hat es ein Display
		//TODO: Weitere Prüfungen
		return true;
	}
	
}