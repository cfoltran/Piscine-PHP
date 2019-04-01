<?php
    require_once('../ex00/Vertex.class.php');
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
                print("contruct successfuly\n");
        }

        function __getX() {
            return ($this->_x);
        }
    }
?>