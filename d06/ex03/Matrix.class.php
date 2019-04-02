<?php
    class Matrix {
        const IDENTITY = "IDENTITY";
        const SCALE = 'SCALE';
        const RX = 'Ox ROTATION';
        const RY = 'Oy ROTATION';
        const RZ = 'Oz ROTATION';
        const TRANSLATION = 'TRANSLATION';
        const PROJECTION = 'PROJECTION';

        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_near;
        private $_far;
        private $_matrix =  [   
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                            ];
        private $_point = ['x', 'y', 'z', 'w'];
        static  $verbose = false;

        function __construct($kwargs) {
            // if (!in_array($kwargs['preset'], [self::IDENTITY, self::SCALE, self::RX, self::RY, self::RZ, self::TRANSLATION, self::PROJECTION]))
            //     return "Error";
            // if (!isset($kwargs['scale']) && $kwargs['preset'] === self::SCALE)
            //     return false;
            // if (!isset($kwargs['angle']) && in_array($kwargs['preset'], [self::RY, self::RX, self::RZ]))
            //     return false;
            if ((!isset($kwargs['vtc']) || !($kwargs['vtc'] instanceof Vector)) && $kwargs['preset'] === self::TRANSLATION)
                return ("error\n");
            // if ((!isset($kwargs['fov']) || !isset($kwargs['ratio']) || !isset($kwargs['near']) || !isset($kwargs['far'])) && $kwargs['preset'] === self::PROJECTION)
            //     return false;
            if (isset($kwargs['preset']) && !empty($kwargs['preset']))
                $this->_preset = $kwargs['preset'];
            if (isset($kwargs['scale']) && !empty($kwargs['scale']) && !empty($kwargs['scale']))
                $_scale = $kwargs['preset'];
            $this->_vtc = $kwargs['vtc'];
            // if (!isset($_preset))
            //     return ("error\n");
            if (self::$verbose) {
                if ($this->_preset == self::IDENTITY)
                    echo "Matrix " . $this->_preset . " instance constructed\n";
                else
                    echo "Matrix " . $this->_preset . " preset instance constructed\n";
            }
            $this->_redirect();
        }

        private function _redirect() {
            if ($this->_preset == self::IDENTITY)
                $this->_identityMatrix();
            if ($this->_preset == self::TRANSLATION)
                $this->_translateMatrix();
            if ($this->_preset == self::SCALE)
                $this->_scaleMatrix();
        }

        private function _identityMatrix() {
            $this->_matrix[0][0] = 1;
            $this->_matrix [1][1] = 1;
            $this->_matrix[2][2] = 1;
            $this->_matrix[3][3] = 1;
        }

        private function _translateMatrix()
        {
            $this->_identityMatrix();
            $this->matrix[0][3] = $this->_vtc->getX();
            $this->matrix[1][3] = $this->_vtc->getY();
            $this->matrix[2][3] = $this->_vtc->getZ();
        }

        public function __toString() {
            $format = "M | vtcX | vtcY | vtcZ | vtxO\n";
            $format .= "-----------------------------\n";
            for ($i = 0; $i < 4; $i++) {
                $format .= ($i > 0) ? "\n" : null;
                $format .= "{$this->_point[$i]}";
                for ($j = 0; $j < 4; $j++)
                    $format .= ' | ' . number_format($this->_matrix[$i][$j], 2, '.', '');
            }
            return ($format);
        }

        static function doc() {
            $fd = fopen('Matrix.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        function __descruct() {
            if (self::$verbose)
                echo "Matrix instance destructed\n";
        }
    }

    require_once('../ex01/Vertex.class.php');
    require_once('../ex02/Vector.class.php');
    Vertex::$verbose = False;
    Vector::$verbose = False;

    print( Matrix::doc() );
    Matrix::$verbose = True;

    print( 'Let\'s start with an harmless identity matrix :' . PHP_EOL );
    $I = new Matrix( array( 'preset' => Matrix::IDENTITY ) );
    print( $I . PHP_EOL . PHP_EOL );

    print( 'So far, so good. Let\'s create a translation matrix now.' . PHP_EOL );
    $vtx = new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 0.0 ) );
    $vtc = new Vector( array( 'dest' => $vtx ) );
    $T  = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $vtc ) );
    print( $T . PHP_EOL . PHP_EOL );

    // print( 'A scale matrix is no big deal.' . PHP_EOL );
    // $S  = new Matrix( array( 'preset' => Matrix::SCALE, 'scale' => 10.0 ) );
    // print( $S . PHP_EOL . PHP_EOL );

    // print( 'A Rotation along the OX axis :' . PHP_EOL );
    // $RX = new Matrix( array( 'preset' => Matrix::RX, 'angle' => M_PI_4 ) );
    // print( $RX . PHP_EOL . PHP_EOL );

    // print( 'Or along the OY axis :' . PHP_EOL );
    // $RY = new Matrix( array( 'preset' => Matrix::RY, 'angle' => M_PI_2 ) );
    // print( $RY . PHP_EOL . PHP_EOL );

    // print( 'Do a barrel roll !' . PHP_EOL );
    // $RZ = new Matrix( array( 'preset' => Matrix::RZ, 'angle' => 2 * M_PI ) );
    // print( $RZ . PHP_EOL . PHP_EOL );

    // print( 'The bad guy now, the projection matrix : 3D to 2D !' . PHP_EOL );
    // print( 'The values are arbitray. We\'ll decipher them in the next exercice.' . PHP_EOL );
    // $P = new Matrix( array( 'preset' => Matrix::PROJECTION,
    //                         'fov' => 60,
    //                         'ratio' => 640/480,
    //                         'near' => 1.0,
    //                         'far' => -50.0 ) );
    // print( $P . PHP_EOL . PHP_EOL );

    // print( 'Matrices are so awesome, that they can be combined !' . PHP_EOL );
    // print( 'This is a model matrix that scales, then rotates around OY axis,' . PHP_EOL );
    // print( 'then rotates around OX axis and finally translates.' . PHP_EOL );
    // print( 'Please note the reverse operations order. It\'s not an error.' . PHP_EOL );
    // $M = $T->mult( $RX )->mult( $RY )->mult( $S );
    // print( $M . PHP_EOL . PHP_EOL );

    // print( 'What can you do with a matrix and a vertex ?' . PHP_EOL );
    // $vtxA = new Vertex( array( 'x' => 1.0, 'y' => 1.0, 'z' => 0.0 ) );
    // print( $vtxA . PHP_EOL );
    // print( $M . PHP_EOL );
    // print( 'Transform the damn vertex !' . PHP_EOL );
    // $vtxB = $M->transformVertex( $vtxA );
    // print( $vtxB . PHP_EOL . PHP_EOL );
?>