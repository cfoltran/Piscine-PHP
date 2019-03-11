#!/usr/bin/php
<?php
    if ($argc == 4) {
        $array = array();
        for ($i = 1; $i < $argc; $i++)
            $array = array_merge($array, explode(' ', preg_replace('/ +/', ' ', trim($argv[$i]))));
        if ($array[1] == '+')
            print_r($array[0] + $array[2] . "\n");
        if ($array[1] == '-')
            print_r($array[0] - $array[2] . "\n");
        if ($array[1] == '*')
            print_r($array[0] * $array[2] . "\n");
        if ($array[1] == '/')
            print_r($array[0] / $array[2] . "\n");
        if ($array[1] == '%')
            print_r($array[0] % $array[2] . "\n");
    } else {
        die("Incorrect Parameters\n");
    }
?>