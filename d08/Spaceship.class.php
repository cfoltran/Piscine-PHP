<?php
    class Spaceship {
        private $_name;
        private $_size = [];
        private $_life;
        private $_engine;

        public function __construct($kwargs) {
            $this->_name = $kwargs['name'];
            $this->_size = $kwargs['size'];
            $this->_life = $kwargs['life'];
            $this->_engine = $kwargs['engine'];
        }
    }
?>