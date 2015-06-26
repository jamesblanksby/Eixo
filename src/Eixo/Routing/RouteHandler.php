<?php

namespace Eixo\Routing;

use Eixo\Routing\Route as Route;
use Eixo\Core\ServiceContainer as Service;
use Eixo\Routing\RouteCollection as Collection;

class RouteHandler {

	public function __construct() {
		$this->collection = new Collection;
	}

	public function collection_add(Route $route) {
		$this->collection->add($route);
	}

	public function route_process($method, $route, $response) {
		if(!is_callable($response) && is_array($response)) {
			$response = $this->response_process($response);
		}

		if(is_array($route)) {
			foreach($route as $route) {
				$this->collection_add(new Route($method, $route, $response));
			}
		} else {
			$this->collection_add(new Route($method, $route, $response));
		}
	}

	public function response_process(array $response) {		
		$type = array_keys($response)[0];
		$action = array_values($response)[0];

		switch($type) {
			case 'controller' :
				return function() use ($action) {
					Service::$service_array['Controller']->load($action);
				};
			break;
			case 'view' :
				if(is_array($action)) {
					return function() use ($action)	{
						Service::$service_array['View']->render($action['view'], (isset($action['title']) ? $action['title'] : null), (isset($action['data']) ? $action['data'] : null));
					};
				} else {
					return function() use ($action) {
						Service::$service_array['View']->render($action);
					};
				}
			break;
		}
	}
}