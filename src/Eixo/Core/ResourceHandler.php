<?php

namespace Eixo\Core;

use Eixo\Exception\ResourceException;

class ResourceHandler {

	public $resource;
	private static $path = 'application/';

	public function path($path) {
		return self::$path = $path;
	}

	public function load($resource) {
		$this->resource = $resource;

		$path = self::$path . $resource;

		if(file_exists($path)) {
			require_once $path;
		} else {
			throw new ResourceException($path . ' does not exist');
		}
	}

	public function path_get($resource) {
		$path = self::$path . $resource;

		if(glob($path) !== null) {
			return glob($path)[0];
		}
	}

	public function style($resource) {
		$path = $this->path_get('asset/css/' . $resource . '.css');

		if($path) {
			return "<link rel='stylesheet' href='" . $_SERVER['ROOT'] . "/" . $path . "'>";
		}
		throw new ResourceException($path . ' does not exist');
	}

	public function script($resource) {
		$path = $this->path_get('asset/script/' . $resource . '.js');

		if($path) {
			return "<script src='" . $_SERVER['ROOT'] . "/" . $path . "'></script>";
		}
		throw new ResourceException($path . ' does not exist');
	}
}