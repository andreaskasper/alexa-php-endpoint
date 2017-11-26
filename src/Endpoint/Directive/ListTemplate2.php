<?php
namespace Alexa\Endpoint\Directive;

class ListTemplate2 implements template {
	
	private $_backgroundimageurl = null;
	private $_imageurl = "https://placehold.it/1920x1080?text=Testy";
	private $_title = "";
	private $_rows = array();
	

	public function __construct() {
	}
	
	public function setTitle($txt) {
		$this->_title = $txt;
	}
	
	public function addItem($token, $title, $imageurl) {
		$b = array(
			"token" => $token,
			"title" => $title,
			"image" => $imageurl
		);
		$this->_rows[] = $b;
	}
	
	
	public function ResponseData() {
		$out = array(
			"type" => "ListTemplate2",
			"token" => "rand_".md5(microtime(true)),
			"backButton" => "VISIBLE",
			"title" => $this->_title,
			"listItems" => array()
		);
		foreach ($this->_rows as $row) {
			$b = array();
			$b["token"] = $row["token"];
			$b["image"] = array(
				"contentDescription" => "a",
				"sources" => array(
				
					array("url" => $row["image"])
				)
			);
			$b["textContent"] = array(
				"primaryText" => array(
					"text" => $row["title"],
					"type" => "PlainText"
				),
				"secondaryText" => array(
					"text" => "",
					"type" => "PlainText"
				),
				"tertiaryText" => array(
					"text" => "",
					"type" => "PlainText"
				)
			);
			$out["listItems"][] = $b;
		}
		
		
		$out = array(
			"type" => "Display.RenderTemplate",
			"template" => $out
		);
		return $out;
	}
}