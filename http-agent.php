<?php

require_once(dirname(__FILE__) . '/http-agent.php');

abstract class HttpAgent {
	public $url;

	protected $curlObj;

	private $headers = array();

	function __construct($initUrl) {
		$this->url = $initUrl;
	}

	protected function generateRequestUrl() {
		return $this->url;
	}

	public function setRequestHeader($field, $value) {
		$this->headers[$field] = $value;
	}

	public function setRequestHeaders($values) {
		if (is_array($values)) {
			foreach ($values as $field => $value) {
				$this->setRequestHeader($field, $value);
			}
		}
	}

	private function generateRequestHeaders() {
		$result = array();
		foreach ($this->headers as $field => $value) {
			$result[] = $field . ': ' . $value;
		}
		return $result;
	}

	public function request() {
		$this->init();
		$this->initOptions();
		$output = $this->execute();
		$this->close();

		return $output;
	}

	public function requestAndSave($physicalPath) {
		$this->init();
		$this->initOptions();

		$stream = fopen($physicalPath, 'w');
		curl_setopt($this->curlObj, CURLOPT_FILE, $stream);

		$output = $this->execute();
		$this->close();
		fclose($stream);

		return $output;
	}

	private function init() {
		$this->curlObj = curl_init();
	}

	protected function initOptions() {
		curl_setopt($this->curlObj, CURLOPT_URL, $this->generateRequestUrl());
		curl_setopt($this->curlObj, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($this->curlObj, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curlObj, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->curlObj, CURLOPT_MAXREDIRS, 10);
		curl_setopt($this->curlObj, CURLOPT_AUTOREFERER, true);
		curl_setopt($this->curlObj, CURLOPT_HEADER, false);
		curl_setopt($this->curlObj, CURLOPT_HTTPHEADER, $this->generateRequestHeaders());
	}

	private function execute() {
		return curl_exec($this->curlObj);
	}

	private function close() {
		curl_close($this->curlObj);
	}
}
