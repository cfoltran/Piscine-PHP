<?php
    abstract class Fighter {
        private $_type;

        public function __construct($name) {
            $this->_type = $name;
        }

        public function getType() {
            return ($this->_type);
        }

        abstract protected function fight($target);
    }
?>