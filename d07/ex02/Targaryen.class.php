<?php
    class Targaryen {
        public function getBurned() {
            if ($this->resistsFire())
                return "burns alive";
            return "emerges naked but unharmed";
        }

        public function resistsFire() {
            return False;
        }
    }
?>