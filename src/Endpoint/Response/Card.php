<?php

namespace Alexa\Endpoint\Response;

class Card  implements template {
	private $_title = "";
	private $_txt = "";
	private $_imagesmall = null;
	private $_imagelarge = null;
	
	public function __construct($title = "", $content = "") {
		$this->_title = $title;
		$this->_txt = $content;
	}
	
	public function setImage($url) {
		$this->_imagesmall = $url;
		$this->_imagelarge = $url;
	}
	
	public function setImageLarge($url) {
		$this->_imagelarge = $url;
	}
	
	public function setImageSmall($url) {
		$this->_imagesmall = $url;
	}
	
	public function ResponseData() {
		$out = array();
			$out["card"] = array(
				"type" => "Standard",
				"title" => $this->_title,
				"text" => $this->_txt,
				"image" => array(
					"smallImageUrl" => $this->_imagesmall,
					"largeImageUrl" => $this->_imagelarge
				)
			);
		return $out;
	}
	
}