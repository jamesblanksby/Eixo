<?php

namespace Eixo\Routing;

use Eixo\Core\ServiceContainer as Service;

class Route {

	public $route;
	public $response;
	public $method = 'GET';

	public function __construct($method, $route, $response) {
		$this->method = $method;
		$this->route = $route;

		preg_match_all('/\{(.*?)\}/', $this->route, $match_array);
		if(count($match_array[1]) > 0) {
			$this->param = array();
			foreach($match_array[1] as $match) {
				$this->config_route = Service::load('Config')->get('route');
				if(array_key_exists($match, $this->config_route['regex_shortcut'])) {
					$regex = $this->config_route['regex_shortcut'][$match];
				} else {
					$regex = $match;
				}

				$this->param[] = null;
				$this->route_param = str_replace('{' . $match . '}', '(' . $regex . ')', $this->route);
				$this->route = str_replace('{' . $match . '}', $regex, $this->route);
			}

			$this->route = str_replace('/', '\/', $this->route);
			$this->route_param = str_replace('/', '\/', $this->route_param);
		}
		
		$this->response = $response;
	}
}