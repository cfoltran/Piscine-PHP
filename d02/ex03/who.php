#!/usr/bin/php
<?php
    date_default_timezone_set('Europe/Paris');
    $file = fopen("/var/run/utmpx", "r");
    while ($utmpx = fread($file, 628)){
        $unpack = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $utmpx);
    }
    print_r($unpack);
?>