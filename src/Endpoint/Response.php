<?php

namespace Alexa\Endpoint;

class Response {
	
	private $_sessionEnd = true;
	private $_datarepromptoutputSpeech = null;
	private $_sessionData = array();
	private $_responses = array();
	private $_repromptText = null;
	private $_directives = array();
	

	public function __construct() {
	
	}
	
	public function SessionEnd(bool $value) {
		$this->_sessionEnd = $value;
	}
	
	public function setSessionValue($key, $value) {
		$this->_sessionData[$key] = $value;
	}
	
	public function say($txt) {
		$b = new Response\Speech();
		$b->text($txt);
		$this->addOutput($b);
	}
	
	public function addOutput(Response\template $obj) {
		$this->_responses[] = $obj;
	}
	
	public function addDirective(Directive\template $obj) {
		$this->_directives[] = $obj;
	}
	
	public function setCardStandard($title, $txt, $img = null) {
		$b = array("type" => "Standard");
		$b["title"] = $title;
		$b["text"] = $txt;
		$b["image"]["smallImageUrl"] = $img;
		$b["image"]["largeImageUrl"] = $img;
		$this->_card = $b;
	}
	
	
	public function repromptText($txt = "Anything else?") {
		$this->_repromptText = $txt;
	}
	
	
	
	
	public function send($sendheaders = true, $exitafter = false) {
		$out = array(
			"version" => "1.0",
			"sessionAttributes" => $this->_sessionData,
			"response" => array(
				"shouldEndSession" => $this->_sessionEnd,
				"directives" => array()
			),
			
		);
		foreach ($this->_responses as $resp) {
			$out["response"] = array_merge($out["response"], $resp->ResponseData());
		}
		
		foreach ($this->_directives as $resp) {
			$out["response"]["directives"][] = $resp->ResponseData();
		}
		
		if ($this->_repromptText != null) {
			$out["response"]["reprompt"]["outputSpeech"] = array(
				"type" => "PlainText",
				"text" => $this->_repromptText
			);
		}

		$out = json_encode($out);
		if (strlen($out) > 24576) throw new Exception("Reponse may not exceed 24kb");
		if ($sendheaders) {
			header("HTTP/1.1 200 OK");
			header("Content-Type: application/json;charset=UTF-8");
			header("Content-Length: ".strlen($out));
		}
		echo($out);
		if ($exitafter) exit(1);
	}
	
	
	
}