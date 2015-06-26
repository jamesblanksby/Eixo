<?php

namespace Eixo\Core;

use Eixo\HTTP\Request as Request;
use Eixo\HTTP\Response as Response;
use Eixo\Routing\RouteHandler as Router;
use Eixo\Core\ResourceHandler as Resource;
use Eixo\Core\ServiceContainer as Service;

class Eixo {

	public function __construct() {
		$this->router = new Router;
		$this->request = new Request;
		$this->resource = new Resource;
		$this->response = new Response;
	}

	public function get($route, $response) {
		return $this->router->route_process('GET', $route, $response);
	}

	public function post($route, $response) {
		return $this->router->route_process('POST', $route, $response);
	}

	public function put($route, $response) {
		return $this->router->route_process('PUT', $route, $response);
	}

	public function delete($route, $response) {
		return $this->router->route_process('DELETE', $route, $response);
	}

	public function any($route, $response) {
		return $this->router->route_process(array('GET', 'POST', 'PUT', 'DELETE'), $route, $response);
	}

	public function dispatch() {
		$this->request->create($_SERVER);

		$match = $this->route_match();

		if(!empty($match)) {
			$this->response->code(200);
			$this->response->body($match->response);
			$this->response->send();
		} else {
			$this->response->code(404);
			$this->response->body(function() {
				$view = Service::load('View');
				$view->render('error/404', 'Page not found');
			});
			$this->response->send();
		}
	}

	public function route_match() {
		$this->route_array = $this->router->collection->route_array;

		foreach($this->route_array as $route) {
			if(is_array($route->method)) {
				foreach($route->method as $method) {
					if(isset($route->param)) {
						if(preg_match('/(^' . $route->route . '$)/', $this->request->request_query) && $this->request->method == $method) {
							if(preg_match_all('/' . $route->route_param . '/', $this->request->request_query, $match_array)) {
								array_shift($match_array);
								foreach($match_array as $match) {
									$match[0] = ltrim($match[0], '/');
									if($match[0] !== $this->request->request_query) {
										$this->request->parameter[] = $match[0];
									}
								}
							}
							return $route;
						}
					} else {
						if($this->request->request_query == $route->route && $this->request->method == $method) {
							return $route;
						}
					}
				}
			}

			if(isset($route->param)) {
				if(preg_match('/(^' . $route->route . '$)/', $this->request->request_query) && $this->request->method == $route->method) {
					if(preg_match_all('/' . $route->route_param . '/', $this->request->request_query, $match_array)) {
						array_shift($match_array);
						foreach($match_array as $match) {
							$match[0] = ltrim($match[0], '/');
							if($match[0] !== $this->request->request_query) {
								$this->request->parameter[] = $match[0];
							}
						}
					}
					return $route;
				}
			} else {
				if($this->request->request_query == $route->route && $this->request->method == $route->method) {
					return $route;
				}
			}
		}
	}
}