<?php
    require_once('../ex01/Vertex.class.php');
    require_once('../ex02/Vector.class.php');
    require_once('Matrix.class.php');

    class Camera {
        private $_tT;
        private $_tR;
        private $_proj;
        private $_origin;
        private $_width;
        private $_height;

        static $verbose = false;

        public function __construct($kwargs) {
            $this->_origin = $kwargs['origin'];
            $this->_tT = new Matrix([
                'preset' => Matrix::TRANSLATION,
                'vtc' => new Vector([
                    'dest' => $this->_origin
                ])
            ]);
            $this->_tR = $this->_transpose($kwargs['orientation']);
            $this->_width = $kwargs['width'];
            $this->_height = $kwargs['height'];
            $this->_ratio = $this->_width / $this->_height;
            $this->_proj = new Matrix([
                'preset' => Matrix::PROJECTION,
                'fov' => $kwargs['fov'],
                'ratio' => $this->_ratio,
                'near' => $kwargs['near'],
                'far' => $kwargs['far']
            ]);
            if (self::$verbose)
                echo "Camera instance constructed\n";
        }

        function _transpose(Matrix $m) {
            $t[0][0] = $m->getMatrix()[0][0];
            $t[0][1] = $m->getMatrix()[1][1];
            $t[0][2] = $m->getMatrix()[2][0];
            $t[0][3] = $m->getMatrix()[3][0];
            $t[1][0] = $m->getMatrix()[0][1];
            $t[1][1] = $m->getMatrix()[1][2];
            $t[1][2] = $m->getMatrix()[2][1];
            $t[1][3] = $m->getMatrix()[3][1];
            $t[2][0] = $m->getMatrix()[0][2];
            $t[2][1] = $m->getMatrix()[1][2];
            $t[2][2] = $m->getMatrix()[2][2];
            $t[2][3] = $m->getMatrix()[3][2];
            $t[3][0] = $m->getMatrix()[0][3];
            $t[3][1] = $m->getMatrix()[1][3];
            $t[3][2] = $m->getMatrix()[2][3];
            $t[3][3] = $m->getMatrix()[3][3];
            $m->_matrix = $t;
            return ($m);
        }

        public function __toString() {
            $tmp = "Camera( \n";
            $tmp .= "+ Origine: ".$this->_origin."\n";
            $tmp .= "+ tT:\n".$this->_tT."\n";
            $tmp .= "+ tR:\n".$this->_tR."\n";
            $tmp .= "+ tR->mult( tT ):\n".$this->_tR->mult($this->_tT)."\n";
            $tmp .= "+ Proj:\n".$this->_proj."\n)";
            return ($tmp);
        }

        static function doc() {
            $fd = fopen('Camera.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        public function __destruct() {
            echo "Camera instance destructed\n";
        }
    }



    Vertex::$verbose = False;
    Vector::$verbose = False;
    Matrix::$verbose = False;
    
    // print( Camera::doc() );
    Camera::$verbose = True;
    
    $vtxO = new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 80.0 ) );
    $R    = new Matrix( array( 'preset' => Matrix::RY, 'angle' => M_PI ) );
    $cam  = new Camera( array( 'origin' => $vtxO,
                               'orientation' => $R,
                               'width' => 640,
                               'height' => 480,
                               'fov' => 60,
                               'near' => 1.0,
                               'far' => 100.0) );
    
    print( $cam . PHP_EOL );
    


?>