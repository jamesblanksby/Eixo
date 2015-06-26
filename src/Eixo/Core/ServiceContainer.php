<?php

namespace Eixo\Core;

use Eixo\Exception\ServiceException;

class ServiceContainer {

	public static $service_array;

	public static function register($service_name, $service) {
		self::$service_array[$service_name] = $service;
	}

	public static function load($service) {
		if(array_key_exists($service, self::$service_array)) {
			return self::$service_array[$service];
		}
		throw new ServiceException('Service name ' . $service . ' is not registered');
	}
}