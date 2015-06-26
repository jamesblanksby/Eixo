<?php

namespace Eixo\Database;

use Eixo\Core\ServiceContainer as Service;

class Database {

	public function __construct() {
		$config = Service::load('Config');
		$database = $config->get('database');

		return $this->db = new \mysqli (
			$database['connection']['host'],
			$database['connection']['user'], 
			$database['connection']['pass'],
			$database['connection']['name']
		);
	}
}