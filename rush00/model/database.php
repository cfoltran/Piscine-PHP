<?php
    class Database {
        public $host;
        public $user;
        public $passwd;
        public $db;
        public $co;

		public function __construct() {
			$this->host = "localhost ";
			$this->user = "rushuser";
			$this->passwd = "Kerrigan";
			$this->db = "rushdb";
		}

        public function login() {
            $this->co = mysqli_connect($this->host, $this->user, $this->passwd, $this->db, 3306);
			return $this->co;
        }

        public function logout() {
            $this->$co->logout();
            mysqli_close();
        }
    }
?>