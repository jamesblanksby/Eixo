<?php

use Eixo\Database\Database;

class UserModel extends Database {

	public function __construct() {
		parent::__construct();
	}

	public function user_get($id) {
		$user_sql = "
			SELECT user.*
			FROM user
			WHERE user.id = $id";
		$user_result = $this->db->query($user_sql);

		if($user_result->num_rows > 0) {
			return $user_result->fetch_object();
		}
		return false;
	}
}