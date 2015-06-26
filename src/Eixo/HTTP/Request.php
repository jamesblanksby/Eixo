<?php

namespace Eixo\HTTP;

class Request {

	public $uri;
	public $url;
	public $host;
	public $time;
	public $method;
	public $request_query;

	public function create(array $request) {
		$this->host = $request['HTTP_HOST'];
		$this->uri = $request['REQUEST_URI'];
		$this->time = $request['REQUEST_TIME'];
		$this->method = $request['REQUEST_METHOD'];
		$this->url = $this->host . $this->uri;
		$this->request_query = (!empty($request['QUERY_STRING']) ? rtrim(str_replace('request=', '/', $request['QUERY_STRING']), '/') : '/');
	}

	public function method() {
		return $this->method;
	}

	public function uri_get() {
		return $this->uri;
	}

	public function query_get() {
		return $this->request_query;
	}
}