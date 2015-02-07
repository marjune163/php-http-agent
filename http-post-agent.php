<?php
require_once(dirname(__FILE__) . '/http-get-agent.php');

class HttpPostAgent extends HttpGetAgent {
	public $postData = '';

	protected function initOptions() {
		parent::initOptions();
		curl_setopt($this->curlObj, CURLOPT_HTTPGET, false);
		curl_setopt($this->curlObj, CURLOPT_POST, true);
		curl_setopt($this->curlObj, CURLOPT_POSTFIELDS, $this->postData);
	}
}