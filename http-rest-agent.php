<?php
require_once(dirname(__FILE__) . '/http-post-agent.php');

class HttpRestAgent extends HttpGetAgent {
	public $postData=null;
	public $method;

	function __construct($initUrl,$initMethod) {
		parent::__construct($initUrl);
		$this->method=$initMethod;
	}

	protected function initOptions() {
		parent::initOptions();
		curl_setopt($this->curlObj, CURLOPT_HTTPGET, false);
		curl_setopt($this->curlObj, CURLOPT_POST, false);
		curl_setopt($this->curlObj, CURLOPT_CUSTOMREQUEST, $this->method);
		curl_setopt($this->curlObj, CURLOPT_POSTFIELDS, is_array($this->postData) ? json_encode($this->postData) : $this->postData);
	}
}
