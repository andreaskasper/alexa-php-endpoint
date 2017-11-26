<?php
namespace Alexa\Endpoint\Directive;

class BodyTemplate2 implements template {
	
	private $_imageurl = "https://placehold.it/1920x1080?text=Testy";
	private $_title = "";
	private $_primaryText = "";
	private $_secondaryText = "";
	private $_tertiaryText = "";

	public function __construct() {
	}
	
	public function setTitle($txt) {
		$this->_title = $txt;
	}
	
	public function setImage($url) {
		$this->_imageurl = $url;
	}
	
	public function setText1($txt) {
		$this->_primaryText = $txt;
	}
	
	public function setText2($txt) {
		$this->_secondaryText = $txt;
	}
	
	public function setText3($txt) {
		$this->_tertiaryText = $txt;
	}
	
	public function ResponseData() {
		$out = array(
			"type" => "BodyTemplate2",
			"token" => "rand_".md5(microtime(true)),
			"backButton" => "VISIBLE",
			"title" => $this->_title,
			"image" => array(
				"contentDescription" => "a",
				"sources" => array(
				
					array("url" => $this->_imageurl)
				)
			),
			"textContent" => array(
				"primaryText" => array(
					"text" => $this->_primaryText,
					"type" => "PlainText"
				),
				"secondaryText" => array(
					"text" => $this->_secondaryText,
					"type" => "PlainText"
				),
				"tertiaryText" => array(
					"text" => $this->_tertiaryText,
					"type" => "PlainText"
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