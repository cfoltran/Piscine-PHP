<?php
    class Vector {
        private $_x;
        private $_y;
        private $_z;
        private $_w = 0;
        static $verbose = false;

        function __construct($kwargs) {
            if (isset($kwargs['dest']) && $kwargs['dest'] instanceof Vertex) {
                if (isset($kwargs['orig']) && $kwargs['orig'] instanceof Vertex) {
                    $origin = new Vertex([
                        'x' => $kwargs['orig']->getX(),
                        'y' => $kwargs['orig']->getY(),
                        'z' => $kwargs['orig']->getZ()
                    ]);
                } else {
                    $origin = new Vertex([
                        'x' => 0,
                        'y' => 0,
                        'z' => 0
                    ]);
                }
                $this->_x = $kwargs['dest']->getX() - $origin->getX();
                $this->_y = $kwargs['dest']->getY() - $origin->getY();
                $this->_z = $kwargs['dest']->getZ() - $origin->getZ();
                $this->_w = 0;
            }
            if (self::$verbose == true)
                printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        }

        public function magnitude() {
            return (float)(sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
        }

        public function normalize() {
            $length = $this->magnitude();
            if ($length == 1) 
                clone $this;
            return (new Vector([
                'dest' => new Vertex([
                    'x' => $this->_x / $length,
                    'y' => $this->_y / $length,
                    'z' => $this->_z / $length,
                ])
            ]));
        }

        public function add(Vector $rhs) {
            return (new Vector([
                'dest' => new Vertex([
                    'x' => $this->_x + $rhs->_x,
                    'y' => $this->_y + $rhs->_y,
                    'z' => $this->_z + $rhs->_z,
                ])
            ]));
        }

        public function sub(Vector $rhs) {
            return (new Vector([
                'dest' => new Vertex([
                    'x' => $this->_x - $rhs->_x,
                    'y' => $this->_y - $rhs->_y,
                    'z' => $this->_z - $rhs->_z,
                ])
            ]));
        }

        public function opposite() {
            return (new Vector([
                'dest' => new Vertex([
                    'x' => $this->_x * -1,
                    'y' => $this->_y * -1,
                    'z' => $this->_z * -1
                ])
            ]));
        }

        public function scalarProduct($k) {
            return (new Vector([
                'dest' => new Vertex([
                    'x' => $this->_x * $k,
                    'y' => $this->_y * $k,
                    'z' => $this->_z * $k
                ])
            ]));
        }

        public function dotProduct(Vector $rhs) {
            return (float)(($this->x * $rhs->x) + ($this->y * $rhs->y) + ($this->z * $rhs->z));
        }

        public function cos(Vector $rhs) {
            return ((($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z)) / sqrt((($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)) * (($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z))));
        }

        public function crossProduct(Vector $rhs)
        {
            return new Vector(array('dest' => new Vertex([
                'x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
                'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
                'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()
            ])));
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

        public function __toString() {
            return (sprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
        }

        static function doc() {
            $fd = fopen('Vector.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        function __destruct() {
            if (self::$verbose == true)
                printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        }
    }
?>