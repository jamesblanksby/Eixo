<?php

namespace Eixo\HTTP\Controller;

use Eixo\Core\ServiceContainer as Service;

class BaseController {

	public function __construct() {
		$this->view = Service::load('View');
		$this->model = Service::load('Model');
	}

}