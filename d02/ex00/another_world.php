#!/usr/bin/php
<?php
    $array = trim($argv[1]);
    $array = preg_replace('/[\t\s]+/', ' ', $array);
    echo $array . "\n";
?>