<?php
require_once(dirname(__FILE__) . '/http-post-form-agent.php');

class HttpUploadAgent extends HttpPostFormAgent {
	private $uploadFiles = array();

	private function doAddUploadFile($filename, $physicalPath) {
		$this->uploadFiles[$filename] = '@' . $physicalPath;
	}

	public function addUploadFile($filename, $physicalPath) {
		$this->doAddUploadFile($filename,$physicalPath);
		$this->generatePostData();
	}

	public function addUploadFiles($files) {
		if (is_array($files)) {
			foreach ($files as $filename => $physicalPath) {
				$this->doAddUploadFile($filename, $physicalPath);
			}

			$this->generatePostData();
		}
	}

	protected function generatePostData() {
		$this->postData = array_merge($this->postValues, $this->uploadFiles);
	}
}