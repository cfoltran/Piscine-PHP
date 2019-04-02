<?php
    class Matrix {
        const IDENTITY = "";
        const SCALE = "";
        const RX = "";
        const RY = "";
        const RZ = "";
        const TRANSLATION = "";
        const PROJECTION = "";

        protected $matrix = [];
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_near;
        private $_far;
        static  $verbose = false;

        public function __contruct($kwargs) {
            if (isset($kwargs['preset']) && !empty($kwargs['preset']))
                $_preset = $kwargs['preset'];
            // if (isset($kwargs['scale']) && !empty($kwargs['scale']) &&)
            //     $_scale = $kwargs['preset'];
            if (!isset($_preset))
                return ("error\n");
            if (self::verbose)
                echo "\n";
        }

        public function __toString() {
            $display = "M | vtcX | vtcY | vtcZ | vtxO\n";
            $display .= "-----------------------------\n";
            $display .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $display .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $display .= "z | %0.2f | %0.2f | 0.2f | %0.2f\n";
            $display .= "w | %0.2f | %0.2f | %0.2f | %0.2f\n";

        }

        function __descruct() {
            if (self::verbose)
                echo "Matrix instance destructed\n";
        }
    }
?>