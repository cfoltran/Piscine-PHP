#!/usr/bin/php
<?php
    $array = array_map('trim', $argv);
    $needle = $array[1];
    $array = array_slice($array, 2);
    foreach ($array as $elem) {
        $s = preg_split('/\:/', $elem);
        if ($s[0] == $needle)
            echo $s[1] . "\n";
    }
?>