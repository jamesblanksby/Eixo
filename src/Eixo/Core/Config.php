<?php

namespace Eixo\Core;

use Eixo\Core\ResourceHandler;
use Eixo\Core\ServiceContainer as Service;
use Eixo\Exception\ConfigException;

class Config {

	public function get($file = null) {
		$this->resource = Service::load('Resource');
		
		if($file === null) {
			$directory = $this->resource->path_get('config');

			$config_file_array = scandir($directory);
			$config_array = array();
			foreach($config_file_array as $file) {
				if(!in_array($file, array('.', '..'))) {
					$path = $this->resource->path_get('config/' . $file);
					if(file_exists($path)) {
						$config = include $path;
						$key = explode('.', $file);
						$config_array[$key[0]] = $config;
					} else {
						throw new ConfigException('Configuration file ' . $file . ' does not exist');
					}
				}
			}
			return $config_array;
		} else {
			$config = include $this->resource->path_get('config/' . $file . '.php');

			if($config !== null) {
				return $config;
			}
			throw new ConfigException('Configuration file "' . $file . '" does not exist');
		}
	}
}