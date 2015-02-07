<?php
require_once(dirname(__FILE__) . '/http-post-agent.php');

class HttpPostFormAgent extends HttpPostAgent {
	protected $postValues = array();

	private function doAddPostParameter($field, $value) {
		$this->postValues[$field] = $value;
	}

	public function addPostParameter($field, $value) {
		$this->doAddPostParameter($field, $value);
		$this->generatePostData();
	}

	public function addPostParameters($values) {
		if (is_array($values)) {
			foreach ($values as $field => $value) {
				$this->doAddPostParameter($field, $value);
			}

			$this->generatePostData();
		}
	}

	protected function generatePostData() {
		$result = '';
		foreach ($this->postValues as $field => $value) {
			if ($result) {
				$result .= '&';
			}

			$result .= urlencode($field) . '=' . urlencode($value);
		}

		$this->postData = $result;
	}
}