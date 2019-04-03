<?php
    require_once('../ex00/Color.class.php');

    Class Vertex {
        private $_x;
        private $_y;
        private $_z;
        private $_w;
        private $_color;

        static $verbose = false;
        
        function __construct($vertex) {
            $this->_x = $vertex['x'];
            $this->_y = $vertex['y'];
            $this->_z = $vertex['z'];
            if (!empty($vertex['w'] && isset($vertex['w'])))
                $this->_w = $vertex['w'];
            else
                $this->_w = 1;
            if (!empty($vertex['color']) && isset($vertex['color']))
                $this->_color = $vertex['color'];
            else
                $this->_color = new Color([
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255
                ]);
            if (self::$verbose)
                printf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
        }

        public function setX($x) {
            $this->_x = $x;
        }

        public function setY($y) {
            $this->_y = $y;
        }

        public function setZ($z) {
            $this->_z = $z;
        }

        public function setW($w) {
            $this->_w = $w;
        }

        public function getX() {
            return ($this->_x);
        }

        public function getY() {
            return ($this->_y);
        }

        public function getZ() {
            return ($this->_z);
        }

        public function getW() {
            return ($this->_w);
        }

        public function getColor() {
            return ($this->color);
        }

        public function __setColor($color) {
            if (self::$verbose)
                $this->color = $color; 
        }

        function __toString() {
            if (self::$verbose)
                return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", [
                        $this->_x,
                        $this->_y,
                        $this->_z,
                        $this->_w,
                        $this->_color->red,
                        $this->_color->green, 
                        $this->_color->blue
                    ]));
            return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }

        static function doc() {
            $fd = fopen('Vertex.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        function __destruct() {
            if (self::$verbose)
                printf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
        }
    }
?>