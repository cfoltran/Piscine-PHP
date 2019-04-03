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
        private $_ratio;
        public  $matrix =  [   
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                                [0, 0, 0, 0],
                            ];
        private $_point = ['x', 'y', 'z', 'w'];
        static  $verbose = false;

        private $_kwargs = [];

        function __construct($kwargs) {
            if (!in_array($kwargs['preset'], [self::IDENTITY, self::SCALE, self::RX, self::RY, self::RZ, self::TRANSLATION, self::PROJECTION]))
                return false;
            if (!isset($kwargs['scale']) && $kwargs['preset'] === self::SCALE)
                return false;
            if (!isset($kwargs['angle']) && in_array($kwargs['preset'], [self::RY, self::RX, self::RZ]))
                return false;
            if ((!isset($kwargs['vtc']) || !($kwargs['vtc'] instanceof Vector)) && $kwargs['preset'] === self::TRANSLATION)
                return false;
            if ((!isset($kwargs['fov']) || !isset($kwargs['ratio']) || !isset($kwargs['near']) || !isset($kwargs['far'])) && $kwargs['preset'] === self::PROJECTION)
                return false;
            if (isset($kwargs['preset']) && !empty($kwargs['preset']))
                $this->_preset = $kwargs['preset'];
            if (isset($kwargs['scale']) && !empty($kwargs['scale']) && !empty($kwargs['scale']))
                $this->_kwargs = $kwargs;

            $this->_scale = $kwargs['scale'];
            $this->_vtc = $kwargs['vtc'];
            $this->_angle = $kwargs['angle'];

            $this->_fov = $kwargs['fov'];
            $this->_ratio = $kwargs['ratio'];
            $this->_near = $kwargs['near'];
            $this->_far = $kwargs['far'];
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
                $this->_identityMatrix(1);
            if ($this->_preset == self::TRANSLATION)
                $this->_translateMatrix();
            if ($this->_preset == self::SCALE)
                $this->_identityMatrix($this->_scale);
            if ($this->_preset == self::RX)
                $this->_rotX();
            if ($this->_preset == self::RY)
                $this->_rotY();
            if ($this->_preset == self::RZ)
                $this->_rotZ();
            if ($this->_preset == self::PROJECTION)
                $this->_projection();
        }

        private function _identityMatrix($sca) {
            $this->_matrix[0][0] = $sca;
            $this->_matrix[1][1] = $sca;
            $this->_matrix[2][2] = $sca;
            $this->_matrix[3][3] = 1;
        }

        private function _projection() {
            $this->_identityMatrix(1);
            $this->_matrix[0][0] = (1 / tan(0.5 * deg2rad($this->_fov))) / $this->_ratio;
            $this->_matrix[1][1] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->_matrix[2][2] = -1 * (($this->_far + $this->_near) / ($this->_far - $this->_near));
            $this->_matrix[2][3] = -1 * ((2 * $this->_far * $this->_near) / ($this->_far - $this->_near));
            $this->_matrix[3][2] = -1;
            $this->_matrix[3][3] = 0;
        }

        private function _translateMatrix() {
            $this->_identityMatrix(1);
            $this->_matrix[0][3] = $this->_vtc->getX();
            $this->_matrix[1][3] = $this->_vtc->getY();
            $this->_matrix[2][3] = $this->_vtc->getZ();
        }

        private function _rotX() {
            $this->_identityMatrix(1);
            $this->_matrix[0][0] = 1;
            $this->_matrix[1][1] = cos($this->_angle);
            $this->_matrix[1][2] = -sin($this->_angle);
            $this->_matrix[2][1] = sin($this->_angle);
            $this->_matrix[2][2] = cos($this->_angle);
        }

        private function _rotY() {
            $this->_identityMatrix(1);
            $this->_matrix[0][0] = cos($this->_angle);
            $this->_matrix[0][2] = sin($this->_angle);
            $this->_matrix[1][1] = 1;
            $this->_matrix[2][0] = -sin($this->_angle);
            $this->_matrix[2][2] = cos($this->_angle);
        }

        private function _rotZ() {
            $this->_identityMatrix(1);
            $this->_matrix[0][0] = cos($this->_angle);
            $this->_matrix[0][1] = -sin($this->_angle);
            $this->_matrix[1][1] = cos($this->_angle);
            $this->_matrix[2][2] = 1;
        }

        public function mult(Matrix $m) {
            $res = [];

            for ($i = 0; $i < count($this->_matrix); $i++) {
                $res[$i] = [];
                for ($j = 0; $j < count($this->_matrix[$i]); $j++) {
                    $add = 0;
                    for ($k = 0; $k < count($m->getMatrix()); $k++) {
                        $add += $this->_matrix[$i][$k] * $m->getMatrix()[$k][$j];
                    }
                    $res[$i][$j] = $add;
                }
            }
            $matrix = new Matrix(false);
            $matrix->_matrix = $res;
            return ($matrix);
        }

        public function transformVertex(Vertex $v) {

            return (new Vertex([
                    'x' => $v->getX() * $this->_matrix[0][0] + $v->getY() * $this->_matrix[0][1] + $v->getZ() * $this->_matrix[0][2] + $v->getW() * $this->_matrix[0][3],
                    'y' => $v->getX() * $this->_matrix[1][0] + $v->getY() * $this->_matrix[1][1] + $v->getZ() * $this->_matrix[1][2] + $v->getW() * $this->_matrix[1][3],
                    'z' => $v->getX() * $this->_matrix[2][0] + $v->getY() * $this->_matrix[2][1] + $v->getZ() * $this->_matrix[2][2] + $v->getW() * $this->_matrix[2][3],
                    'w' => $v->getX() * $this->_matrix[3][0] + $v->getY() * $this->_matrix[3][1] + $v->getZ() * $this->_matrix[3][2] + $v->getW() * $this->_matrix[3][3],
                    'color' => $v->getColor()
            ]));
        }

        public function getMatrix() {
            return ($this->_matrix);
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

        function __destruct() {
            if (self::$verbose)
                echo "Matrix instance destructed\n";
        }
    }

    // require_once('../ex01/Vertex.class.php');
    // require_once('../ex02/Vector.class.php');
    // Vertex::$verbose = False;
    // Vector::$verbose = False;

    // print( Matrix::doc() );
    // Matrix::$verbose = True;

    // print( 'Let\'s start with an harmless identity matrix :' . PHP_EOL );
    // $I = new Matrix( array( 'preset' => Matrix::IDENTITY ) );
    // print( $I . PHP_EOL . PHP_EOL );

    // print( 'So far, so good. Let\'s create a translation matrix now.' . PHP_EOL );
    // $vtx = new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 0.0 ) );
    // $vtc = new Vector( array( 'dest' => $vtx ) );
    // $T  = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $vtc ) );
    // print( $T . PHP_EOL . PHP_EOL );

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