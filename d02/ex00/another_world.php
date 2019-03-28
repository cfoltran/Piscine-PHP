#!/usr/bin/php
<?php
    if ($argv[1])
    {
        $array = trim($argv[1]);
        $array = preg_replace('/[\t\s]+/', ' ', $array);
        echo "$array\n";
    }
?>