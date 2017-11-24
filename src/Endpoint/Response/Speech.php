<?php
namespace Alexa\Endpoint\Response;

class Speech implements template {
	
	private $_txt = "";

	public function text($txt = "") {
		$this->_txt = $txt;
	}

	
	public function ResponseData() {
		$out = array();
		$out["outputSpeech"]["type"] = "PlainText";
		$out["outputSpeech"]["text"] = $this->_txt;
		return $out;
	}
	
}