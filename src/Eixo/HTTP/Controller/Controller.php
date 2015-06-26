<?php

namespace Eixo\HTTP\Controller;

use Eixo\Core\ResourceHandler;
use Eixo\Core\ServiceContainer as Service;

class Controller {

	public $class;
	public $method;

	public function __construct($class, $method) {
		$this->class = $class;
		$this->method = $method;
		$this->resource = Service::load('Resource');

		$this->app = Service::load('Core');
		$this->param = $this->app->request->parameter;

		$this->controller_load();
	}

	public function controller_load() {
		$path = $this->resource->path_get('controller/' . $this->class . '.php');

		if(file_exists($path)) {
			require_once $path;

			$controller = new $this->class;

			if(method_exists($controller, $this->method)) {
				if($this->param !== null) {
					return call_user_func_array(array($controller, $this->method), $this->param);
				}
				return $controller->{$this->method}();
			} else {
				return $controller->main();
			}
		}
	}
}