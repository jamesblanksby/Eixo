<?php

namespace Eixo\HTTP;

class Response {

	public $body;
	public $code;
	public $header;

	public function header_set($header, $value) {
		return $this->header[$header] = $value;
	}

	public function header_send($header_array = false) {
		if($header_array) {
			foreach($header_array as $header => $value) {
				return header($header . ':' . $value);
			}
		} else {
			foreach($this->header_array as $header => $value) {
				return header($header . ':' . $value);
			}
		}
	}

	public function code($code) {
		$this->code = $code;
		return http_response_code($this->code);
	}

	public function body($body) {
		$this->body = $body;
	}

	public function send() {
		if(is_callable($this->body)) {
			return call_user_func($this->body);
		} else {
			return $this->body;
		}
	}

	public function redirect($url) {
		$this->code(302);
		$this->header_set('Location', $url);
		$this->header_send();
	}
}