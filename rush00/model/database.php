<?php
    class Database {
        public $host;
        public $user;
        public $passwd;
        public $db;
        public $co;

		public function __construct() {
			$this->host = "192.168.99.100";
			$this->user = "adm";
			$this->passwd = "1DvNBIYPxvAixJ1I";
			$this->db = "db_fakir";
		}

        public function login() {
            $this->co = mysqli_connect($this->host, $this->user, $this->passwd, $this->db, 3306)
            or die("Error : failed to connect to the server");
			return $this->co;
        }

        public function logout() {
            $this->$co->logout();
            mysqli_close();
        }
    }
?>