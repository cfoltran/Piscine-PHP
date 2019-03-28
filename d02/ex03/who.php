#!/usr/bin/php
<?php

    date_default_timezone_set('Europe/Paris');
    $file = fopen("/var/run/utmpx", "r");
    $users = array();
    while ($utmpx = fread($file, 628)) {
        $unpack = unpack("a256usr/a4id/a32tty/ipid/itype/I2t", $utmpx);
        if (strcmp($unpack['type'], '7') == 0)
            $users[] = $unpack;
    }

    $smax1 = 0;
    foreach ($users as $user) {
        $len = strlen(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $user['usr']));
        if ($len > $smax1)
            $smax1 = $len;
    }

    $smax2 = 0;
    foreach ($users as $user) {
        $len = strlen(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $user['tty']));
        if ($len > $smax2)
            $smax2 = $len;
    }

    foreach ($users as $user) {
        ksort($user);
        $user['usr'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $user['usr']);
        $user['tty'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $user['tty']);
        $pad1 =  str_pad($user['usr'], $smax1);
        $pad2 = str_pad($user['tty'], $smax2);
        printf("%s %s  %s\n", $pad1, $pad2, date("M j H:i", $user['t1']));
    }
?>
