#!/usr/bin/php
<?php
    function desc($array) {
        rsort($array);
        return $array;
    }

    function asc($array) {
        sort($array);
        return $array;
    }
    
    function ft_is_sort($array) {
        return ((desc($array) === $array) || (asc($array) === $array)) ? 1 : 0;
    }
?>