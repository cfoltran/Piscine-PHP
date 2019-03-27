#!/usr/bin/php
<?php
    if ($argc >= 3) {
        $array = array_map('trim', $argv);
        $needle = $array[1];
        $array = array_slice($array, 2);
        foreach ($array as $elem) {
            $s = preg_split('/\:/', $elem);
            if ($s[0] == $needle)
                $res = $s[1];
        }
        if ($res)
            echo "$res\n";
    }
?>