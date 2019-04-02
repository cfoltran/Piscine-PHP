<?php
    class Color {
        public $red;
        public $green;
        public $blue;
        static $verbose = false;

        function __construct($kwargs) {
            if (isset($kwargs['rgb'])) {
                $this->red = intval($kwargs['rgb'] / 65536 % 256);
                $this->green = intval($kwargs['rgb'] / 256 % 256);
                $this->blue = intval($kwargs['rgb'] % 256);
            } else if (isset($kwargs['red']) && isset($kwargs['green']) && isset($kwargs['blue'])) {
                $this->red = intval($kwargs['red']);
                $this->green = intval($kwargs['green']);
                $this->blue = intval($kwargs['blue']);
            }
            if (self::$verbose === true) {
                printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
            }
        }

        function add($color) {
            $add = [
                'red' => $color->red + $this->red, 
                'green' => $color->green + $this->green,
                'blue' => $color->blue + $this->blue 
            ];
            return (new Color($add));
        }

        function sub($color) {
            $sub = [
                'red' => $this->red - $color->red, 
                'green' => $this->green - $color->green,
                'blue' => $this->blue - $color->blue,
            ];
            return (new Color($sub));
        }

        function mult($color) {
            $mult = [
                'red' => $this->red * $color->red, 
                'green' => $this->green * $color->green,
                'blue' => $this->blue * $color->blue,
            ];
            return (new Color($mult));
        }

        function __toString() {
            return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->red));
        }

        static function doc() {
            $fd = fopen('Color.doc.txt', 'r');
            while ($fd && !feof($fd))
                echo fgets($fd);
            echo "\n";
            fclose($fd);
        }

        function __destruct() {
            if (self::$verbose === true) {
                printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
            }
        }
    }
    print( Color::doc() );
Color::$verbose = True;

$red     = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0    ) );
$green   = new Color( array( 'rgb' => 255 << 8 ) );
$blue    = new Color( array( 'red' => 0   , 'green' => 0   , 'blue' => 0xff ) );

$yellow  = $red->add( $green );
$cyan    = $green->add( $blue );
$magenta = $blue->add( $red );

$white   = $red->add( $green )->add( $blue );

print( $red     . PHP_EOL );
print( $green   . PHP_EOL );
print( $blue    . PHP_EOL );
print( $yellow  . PHP_EOL );
print( $cyan    . PHP_EOL );
print( $magenta . PHP_EOL );
print( $white   . PHP_EOL );

Color::$verbose = False;

$black = $white->sub( $red )->sub( $green )->sub( $blue );
print( 'Black: ' . $black . PHP_EOL );

Color::$verbose = True;

$darkgrey = new Color( array( 'rgb' => (10 << 16) + (10 << 8) + 10 ) );
print( 'darkgrey: ' . $darkgrey . PHP_EOL );
$lightgrey = $darkgrey->mult( 22.5 );
print( 'lightgrey: ' . $lightgrey . PHP_EOL );

$random = new Color( array( 'red' => 12.3, 'green' => 31.2, 'blue' => 23.1 ) );
print( 'random: ' . $random . PHP_EOL );
?>