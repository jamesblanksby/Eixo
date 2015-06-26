<?php

namespace Eixo\HTTP\Controller;

class ControllerHandler {

	public function load($class) {
		if(strpos($class, '/')) {
			$class = explode('/', $class);
			return new Controller($class[0], $class[1]);
		} else {
			return new Controller($class, 'main');
		}
	}
}