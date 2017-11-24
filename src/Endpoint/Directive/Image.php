<?php
namespace Alexa\Endpoint\Directive;

class Image implements template {
	
	private $_url = "https://placehold.it/1920x1080?text=Testy";
	private $_title = "";

	public function __construct($url) {
		$this->_url = $url;
	}
	
	public function setTitle($txt) {
		$this->_title = $txt;
	}
	
	public function ResponseData() {
		$out = array(
			"type" => "BodyTemplate1",
			"token" => "ImageTemplate_".md5($this->_url.$this->_title),
			"backButton" => "VISIBLE",
			"title" => $this->_title,
			"backgroundImage" => array(
				"contentDescription" => "a",
				"sources" => array(
				
					array("url" => $this->_url)
				)
			),
			"image" => array(
				"contentDescription" => "a",
				"sources" => array(
				
					array("url" => $this->_url)
				)
			)
		);
		$out = array(
			"type" => "Display.RenderTemplate",
			"template" => $out
		);
		return $out;
	}
	
}