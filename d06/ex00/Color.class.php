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
            return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->red));
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
?>