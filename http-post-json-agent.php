<?php
require_once(dirname(__FILE__) . '/http-post-agent.php');

class HttpPostJsonAgent extends HttpGetAgent {
	public $postData=null;

	function __construct($initUrl) {
		parent::__construct($initUrl);
		$this->setRequestHeader('Content-Type','application/json');
	}

	protected function initOptions() {
		parent::initOptions();
		curl_setopt($this->curlObj, CURLOPT_HTTPGET, false);
		curl_setopt($this->curlObj, CURLOPT_POST, false);
		curl_setopt($this->curlObj, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($this->curlObj, CURLOPT_POSTFIELDS, is_array($this->postData) ? json_encode($this->postData) : $this->postData);
	}
}
