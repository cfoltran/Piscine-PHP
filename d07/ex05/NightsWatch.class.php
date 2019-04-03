<?php
    class NightsWatch {
        public $fighters = [];

        public function recruit($name) {
            $this->fighters[] = $name;
        }

        public function fight() {
            foreach ($this->fighters as $fighter)
                if ($fighter instanceof IFighter)
                    $fighter->fight();
        }
    }
?>