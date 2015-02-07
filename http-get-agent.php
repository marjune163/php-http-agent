<?php

require_once(dirname(__FILE__) . '/http-agent.php');

class HttpGetAgent extends HttpAgent {
	private $searches = '';

	public function addGetParameter($field, $value) {
		if ($this->searches) {
			$this->searches .= '&';
		}

		$this->searches .= urlencode($field) . '=' . urlencode($value);
	}

	public function addGetParameters($values) {
		if (is_array($values)) {
			foreach ($values as $field => $value) {
				$this->addGetParameter($field, $value);
			}
		}
	}

	protected function generateRequestUrl() {
		$requestUrl = $this->url;

		if ($this->searches) {
			if (strpos($requestUrl, '?') === false) {
				$requestUrl .= '?';
			} else {
				$requestUrl .= '&';
			}

			$requestUrl .= $this->searches;
		}

		return $requestUrl;
	}

	protected function initOptions() {
		parent::initOptions();
		curl_setopt($this->curlObj, CURLOPT_HTTPGET, true);
	}

}
