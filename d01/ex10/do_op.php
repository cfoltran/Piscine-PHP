#!/usr/bin/php
<?php
    if ($argc == 4) {
        $array = array();
        array_shift($argv);
        foreach ($argv as $value)
            $array = array_merge($array, explode(' ', preg_replace('/ +/', ' ', trim($value))));
        if (!is_numeric($array[0]) || !is_numeric($array[2]))
            return ;
        if ($array[1] == '+')
            print_r($array[0] + $array[2] . "\n");
        else if ($array[1] == '-')
            print_r($array[0] - $array[2] . "\n");
        else if ($array[1] == '*')
            print_r($array[0] * $array[2] . "\n");
        else if ($array[1] == '/' && $array[2] != 0)
            print_r($array[0] / $array[2] . "\n");
        else if ($array[1] == '%' && $array[2] != 0)
            print_r($array[0] % $array[2] . "\n");
        else
            return ;
    } else {
        die("Incorrect Parameters\n");
    }
?>