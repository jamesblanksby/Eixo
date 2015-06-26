<?php

namespace Eixo\Database;

use Eixo\Core\ResourceHandler;
use Eixo\Core\ServiceContainer as Service;
use Eixo\Exception\ModelException;

class Model {

	public $model;
	public $model_class;

	public function __construct($model) {
		$this->model_class = $model;
		$this->resource = Service::load('Resource');

		return $this->get();
	}

	public function get() {
		$path = $this->resource->path_get('model/' . $this->model_class . '.php');

		if(file_exists($path)) {
			require_once $path;

			return $this->model = new $this->model_class;
		}
		throw new ModelException('Model class ' . $this->model_class . 'does not exist');
	}
}