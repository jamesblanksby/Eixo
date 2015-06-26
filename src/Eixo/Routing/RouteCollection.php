<?php

namespace Eixo\Routing;

class RouteCollection {

	public $route_array = array();

	public function add($route) {
		return $this->route_array[] = $route;
	}
}