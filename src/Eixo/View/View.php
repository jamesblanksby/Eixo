<?php

namespace Eixo\View;

use Eixo\Core\ServiceContainer as Service;

class View {

	public $view;
	public $data;
	public $title;

	public function __construct($view, $title = false, $data = false) {
		$this->view = $view;
		$this->data = $data;
		$this->title = $title;

		$this->resource = Service::load('Resource');

		$this->view_render();
	}

	public function view_render() {
		$path = $this->resource->path_get('view/' . $this->view . '.*');

		if(isset($this->data) && is_array($this->data)) {
			foreach($this->data as $key => $value) {
				$this->{$key} = $value;
			}
		}

		if(file_exists($path)) {
			require_once $path;
			return $this;
		}
	}
}