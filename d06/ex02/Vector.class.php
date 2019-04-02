<?php
    require_once('../ex01/Vertex.class.php');
    require_once('../ex00/Color.class.php');

    class Vector {
        public $_x;
        public $_y;
        public $_z;
        public $_w = 0;
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


Vertex::$verbose = False;

print( Vector::doc() );
Vector::$verbose = True;


$vtxO = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
$vtxX = new Vertex( array( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0 ) );
$vtxY = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0 ) );
$vtxZ = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0 ) );

$vtcXunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxX ) );
$vtcYunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxY ) );
$vtcZunit = new Vector( array( 'orig' => $vtxO, 'dest' => $vtxZ ) );

print( $vtcXunit . PHP_EOL );
print( $vtcYunit . PHP_EOL );
print( $vtcZunit . PHP_EOL );

$dest1 = new Vertex( array( 'x' => -12.34, 'y' => 23.45, 'z' => -34.56 ) );
Vertex::$verbose = True;
$vtc1  = new Vector( array( 'dest' => $dest1 ) );
Vertex::$verbose = False;

$orig2 = new Vertex( array( 'x' => 23.87, 'y' => -37.95, 'z' => 78.34 ) );
$dest2 = new Vertex( array( 'x' => -12.34, 'y' => 23.45, 'z' => -34.56 ) );
$vtc2  = new Vector( array( 'orig' => $orig2, 'dest' => $dest2 ) );

print( 'Magnitude is ' . $vtc2->magnitude() . PHP_EOL );

$nVtc2 = $vtc2->normalize();
print( 'Normalized $vtc2 is ' . $nVtc2 . PHP_EOL );
print( 'Normalized $vtc2 magnitude is ' . $nVtc2->magnitude() . PHP_EOL );

print( '$vtc1 + $vtc2 is ' . $vtc1->add( $vtc2 ) . PHP_EOL );
print( '$vtc1 - $vtc2 is ' . $vtc1->sub( $vtc2 ) . PHP_EOL );
print( 'opposite of $vtc1 is ' . $vtc1->opposite() . PHP_EOL );
print( 'scalar product of $vtc1 and 42 is ' . $vtc1->scalarProduct( 42 ) . PHP_EOL );
print( 'dot product of $vtc1 and $vtc2 is ' . $vtc1->dotProduct( $vtc2 ) . PHP_EOL );
print( 'cross product of $vtc1 and $vtc2 is ' . $vtc1->crossProduct( $vtc2 ) . PHP_EOL );
print( 'cross product of $vtcXunit and $vtcYunit is ' . $vtcXunit->crossProduct( $vtcYunit ) . 'aka $vtcZunit' . PHP_EOL );
print( 'cosinus of angle between $vtc1 and $vtc2 is ' . $vtc1->cos( $vtc2 ) . PHP_EOL );
print( 'cosinus of angle between $vtcXunit and $vtcYunit is ' . $vtcXunit->cos( $vtcYunit ) . PHP_EOL );

?>