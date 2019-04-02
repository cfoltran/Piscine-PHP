<?php
    require_once('../ex00/Color.class.php');

    Class Vertex {
        private $_x;
        private $_y;
        private $_z;
        private $_w = 1;
        private $_color;
        static  $verbose = false;
        
        function __construct($vertex) {
            $this->$_x = $vertex['x'];
            $this->$_y = $vertex['y'];
            $this->$_x = $vertex['z'];
            if (!empty($vertex['w'] && isset($vertex['w'])))
                $this->$_w = $vertex['w'];
            if (!empty($vertex['color']) && isset($vertex['color']))
                $this->$_color = $vertex['color'];
            else
                $_color = new Color([
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255
                ]);
            if (self::verbose)
                print("construct successfully\n");
        }

        function setX($x) {
            $this->_x = $x;
        }

        function setY($y) {
            $this->_y = $y;
        }

        function setZ($z) {
            $this->_z = $z;
        }

        function setW($w) {
            $this->_w = $w;
        }

        function __getX() {
            return ($this->_x);
        }

        function __getY() {
            return ($this->_y);
        }

        function __getZ() {
            return ($this->_z);
        }

        function __getW() {
            return ($this->_w);
        }

        function __getColor() {
            return ($this->color);
        }

        function __setColor($color) {
            if (self::verbose)
                $this->color = $color; 
        }

        function toString() {
            if (self::verbose)
                printf("toString\n");
        }

        static function doc() {
            $fd = fopen('Vertex.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        function __descruct() {
            if (self::verbose)
                printf("destruct successfully\n");
        }
    }
?>