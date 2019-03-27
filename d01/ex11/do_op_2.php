#!/usr/bin/php
<?php
    if ($argc == 2) {
        $array = trim($argv[1]);
        $sign = 0;
        $sign = (strpos($array, '+')) ? '+' : $sign;
        $sign = (strpos($array, '-')) ? '-' : $sign;
        $sign = (strpos($array, '*')) ? '*' : $sign;
        $sign = (strpos($array, '/')) ? '/' : $sign;
        $sign = (strpos($array, '%')) ? '%' : $sign;
        if (strpos($array, $sign)) {
            $array = array_map('trim' , preg_split('/\\'. $sign .'/', $array));
            if (is_numeric($array[0]) && is_numeric($array[1])) {
                if ($array[1] == 0 && ($sign == '%' || $sign == '/'))
                    exit();
                ($sign == '+') ? print_r($array[0] + $array[1] . "\n") : 0;
                ($sign == '-') ? print_r($array[0] - $array[1] . "\n") : 0;
                ($sign == '*') ? print_r($array[0] * $array[1] . "\n") : 0;
                ($sign == '/') ? print_r($array[0] / $array[1] . "\n") : 0;
                ($sign == '%') ? print_r($array[0] % $array[1] . "\n") : 0;
            } else
                echo "Syntax Error\n";
        } else
            echo "Syntax Error\n";
    } else
        die("Incorrect Parameters\n");
?>