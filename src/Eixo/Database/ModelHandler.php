<?php

namespace Eixo\Database;

class ModelHandler {

	public function load($model) {
		return new Model($model);
	}
}