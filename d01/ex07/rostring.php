#!/usr/bin/php
<?php
        $s = preg_split('/\s+/', trim($argv[1]));
        $first = $s[0];
        array_shift($s);
        foreach ($s as $value)
            echo "$value ";
        echo $first;
?>