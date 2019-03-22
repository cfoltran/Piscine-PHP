<?php
	class User {
		public $co;
		public $id;
		public $user;
		public $pwd;

		function __construct() {
			if(func_num_args() == 3) {
				$list_arg = func_get_args();
				$this->co = $list_arg[0];
				$this->user = $list_arg[1];
				$this->pwd = $list_arg[2];
		}
	}

		function update_password($mdp) {
			$this->pwd = $mdp;
			mysqli_query("UPDATE benevole SET mdpasse = '$this->pwd' WHERE id = '$this->id'");
		}

		function login() {
			session_start();
		}

		function logout() {
			session_destroy();
		}
	}
?>
