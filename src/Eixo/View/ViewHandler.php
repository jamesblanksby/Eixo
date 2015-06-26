<?php

namespace Eixo\View;

use Eixo\View\View;

class ViewHandler {

	public function render($view = false, $title = false, $data = false) {
		return new View($view, $title, $data);
	}
}