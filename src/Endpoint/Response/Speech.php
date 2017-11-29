<?php
namespace Alexa\Endpoint\Response;

class Speech implements template {
	
	private $_txt = "";

	public function text($txt = "") {
		$this->_txt = $txt;
	}

	public function say($txt = "") {
		$this->_txt .= $txt.' ';
	}
	
	public function whisper($txt = "") {
		$this->_txt .= '<amazon:effect name="whispered">'.$txt.'</amazon:effect> ';
	}
	
	public function phoneme($txt = "",$ipa = null, $type = "ipa") {
		$this->_txt .= '<phoneme alphabet="ipa" ph="'.$ipa.'̯">'.$txt.'</phoneme> ';
	}

	/**
	  * 
	  * Convert-Example: ffmpeg -i <input-file> -ac 2 -codec:a libmp3lame -b:a 48k -ar 16000 <output-file.mp3>
	  */
	public function mp3($url) {
		$this->_txt .= '<audio src="'.$url.'" /> ';
	}
	
	public function ResponseData() {
		$out = array();
		if (strpos($this->_txt, "<") !== FALSE AND strpos($this->_txt, ">") !== FALSE) {
			$out["outputSpeech"]["type"] = "SSML";
			$out["outputSpeech"]["ssml"] = '<speak>'.$this->_txt.'</speak>';
		} else {
			$out["outputSpeech"]["type"] = "PlainText";
			$out["outputSpeech"]["text"] = $this->_txt;
		}
		return $out;
	}
	
}