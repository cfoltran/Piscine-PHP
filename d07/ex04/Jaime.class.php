<?php
    class Jaime extends Lannister {
        public function sleepWith($name) {
            if ($name instanceof Cersei)
                echo "With pleasure, but only in a tower in Winterfell, then.\n";
            else
                parent::sleepWith($name);
        }
    }
?>