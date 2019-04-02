<?php
    require_once('../ex00/Vertex.class.php');

    class Vector {
        public $_x;
        public $_y;
        public $_z;
        public $_w = 0;
        public $verbose = false;

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
                $this->_x = $kwargs['dest']->getX() - $origin['x']->getX();
                $this->_y = $kwargs['dest']->getY() - $origin['y']->getY();
                $this->_z = $kwargs['dest']->getZ() - $origin['z']->getZ();
                $this->_w = 0;
            }
            if (self::verbose == true)
                printf("Construct sucessfully");
        }

        public function magnitude() {
            return (float)(sqrt(pow($this->_x, 2), pow($this->_y, 2), pow($this->_z, 2)));
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
            // TODO
        }

        public function crossProduct(Vector $rhs) {
            // TODO
        }

        public function __getX() {
            return ($this->_x);
        }

        public function __getY() {
            return ($this->_y);
        }

        public function __getZ() {
            return ($this->_z);
        }

        public function __getW() {
            return ($this->_w);
        }

        public function toString() {
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