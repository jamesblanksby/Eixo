<?php

use Eixo\HTTP\Controller\BaseController;

class UserController extends BaseController {

	public function __construct() {
		parent::__construct();
		
		$this->user_model = $this->model->load('UserModel')->get();
	}

	public function get($id) {
		$user = $this->user_model->user_get($id);

		$this->view->render('user', 'User', ['user' => $user]);
	}
}