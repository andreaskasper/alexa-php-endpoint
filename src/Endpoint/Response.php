<?php

namespace \Alexa\Endpoint;

class AlexaResponse {
	
	private $_sessionEnd = true;
	private $_dataoutputSpeech = null;
	private $_card = null;
	private $_datarepromptoutputSpeech = null;
	private $_sessionData = array();
	

	public function __construct() {
	
	}
	
	public function SessionEnd($value) {
		$this->_sessionEnd = $value;
	}
	
	public function setSessionValue($key, $value) {
		$this->_sessionData[$key] = $value;
	}
	
	public function sayText($txt) {
		$this->_dataoutputSpeech = array(
			"type" => "PlainText",
			"text" => $txt
		);
	}
	
	public function setCardStandard($title, $txt, $img = null) {
		$b = array("type" => "Standard");
		$b["title"] = $title;
		$b["text"] = $txt;
		$b["image"]["smallImageUrl"] = $img;
		$b["image"]["largeImageUrl"] = $img;
		$this->_card = $b;
	}
	
	
	public function repromptText($txt) {
		$this->_datarepromptoutputSpeech = array(
			"type" => "PlainText",
			"text" => $txt
		);
	}
	
	
	
	
	public function send() {
		$out = array(
			"version" => "1.0",
			"sessionAttributes" => $this->_sessionData,
			"response" => array(
				"outputSpeech" => $this->_dataoutputSpeech,
				"reprompt" => array(
					"outputrepromptSpeech" => $this->_dataoutputSpeech,
				),
				"shouldEndSession" => $this->_sessionEnd
			)
		);
		if ($this->_card != null) $out["response"]["card"] = $this->_card;
		die(json_encode($out));
	}
	
	
	
}