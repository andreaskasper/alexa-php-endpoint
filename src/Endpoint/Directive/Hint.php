<?php
namespace Alexa\Endpoint\Directive;

class Hint implements template {
	
	private $_text = "";
	
	public function __construct($txt) {
		$this->_text = $txt;
	}
		
	public function ResponseData() {
		$out = array(
			"type" => "Hint",
			"hint" => array(
				"type" => "PlainText",
				"text" => $this->_text
				
			
			)
		);
		return $out;
	}
}