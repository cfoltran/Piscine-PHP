<?php
    class UnholyFactory {
        private $_fighter = [];

        public function absorb($cs) {
            if (get_parent_class($cs) === Fighter::class) {
                if (!isset($this->_fighter[$cs->getType()])) {
                    echo "(Factory absorbed a fighter of type " . $cs->getType() . ")\n";
                    $this->_fighter[$cs->getType()] = $cs;
                }
                else {
                    echo "(Factory already absorbed a fighter of type " . $cs->getType() . ")\n";
                }
            } else {
                echo "(Factory can't absorb this, it's not a fighter)\n";
            }
        }

        public function fabricate($rf) {
            if (!isset($this->_fighter[$rf])) {
                echo "(Factory hasn't absorbed any fighter of type " . $rf . ")\n";
            } else {
                echo "(Factory fabricates a fighter of type " . $rf . ")\n";
                return $this->_fighter[$rf];
            }
        }
    }
?>