<?php
    class Imperial extends Spaceship {
        private $_sprite;

        public function __construct($kwargs) {
            $this->_sprite = $kwargs['sprite'];
        }

        public function getSprite() {
            return ($this->sprite);
        }
    }
?>