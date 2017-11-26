<?php
namespace Alexa\Endpoint\Directive;

class BodyTemplate implements template {
	
	private $_backgroundimageurl = null;
	private $_imageurl = "https://placehold.it/1920x1080?text=Testy";
	private $_type = 1;
	private $_title = "";
	private $_primaryText = "";
	private $_primaryType = "PlainText";
	private $_secondaryText = "";
	private $_secondaryType = "PlainText";
	private $_tertiaryText = "";
	private $_tertiaryType = "PlainText";
	private $_BackButton = "VISIBLE";

	public function __construct($type = 1) {
		$this->_type = $type;
	}
	
	public function setTitle($txt) {
		$this->_title = $txt;
	}
	
	public function setBackgroundImage($url) {
		$this->_backgroundimageurl = $url;
	}
	
	public function setImage($url) {
		$this->_imageurl = $url;
	}
	
	public function setText1($txt) {
		$this->_primaryText = $txt;
		$this->_primaryType = "RichText";
	}
	
	public function setPlainText1($txt) {
		$this->_primaryText = $txt;
		$this->_primaryType = "PlainText";
	}
	
	public function setText2($txt) {
		$this->_secondaryText = $txt;
		$this->_secondaryType = "RichText";
	}
	
	public function setText3($txt) {
		$this->_tertiaryText = $txt;
		$this->_tertiaryType = "RichText";
	}
	
	public function ResponseData() {
		$out = array(
			"type" => "BodyTemplate".$this->_type,
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
					"type" => $this->_primaryType
				),
				"secondaryText" => array(
					"text" => $this->_secondaryText,
					"type" => $this->_secondaryType
				),
				"tertiaryText" => array(
					"text" => $this->_tertiaryText,
					"type" => $this->_tertiaryType
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