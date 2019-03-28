#!/usr/bin/php
<?php
    date_default_timezone_set('Europe/Paris');
    $file = fopen("/var/run/utmpx", "r");
    $users = array();
    while ($utmpx = fread($file, 628)) {
        $unpack = unpack("a256usr/a4id/a32ttys/ipid/itype/I2t", $utmpx);
        if (strcmp($unpack['type'], '7') == 0)
            $users[] = $unpack;
    }
    
    foreach ($users as $user) {
        printf("%s %s  %s\n", $user['usr'], $user['ttys'], date("M j H:i", $user['t1']));
    }
?>