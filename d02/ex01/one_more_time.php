#!/usr/bin/php
<?php
    $param = preg_split('/\s/', $argv[1]);
    date_default_timezone_set('Europe/Paris');
    $months = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
    if (count($param) == 5) {
        $check = 0;
        if (!preg_match('/^((((L|l)un|(M|m)(ar|ercre)|(J|j)eu|(V|v)endre|(S|s)ame)(di))|((D|d)imanche))$/', $param[0]))
            ++$check;
        if (!($param[1] >= 1 && $param[1] <= 31))
            ++$check;
        if (!($monthi = preg_grep("/^" . $param[2] . "$/", array_map('ucfirst', $months))))
            ++$check;
        if (!preg_match('/^(1|2)[0-9]{3}$/', $param[3]))
            ++$check; 
        if (!preg_match('/(^([01]\d|2[0-3])):([0-5]\d):([0-5]\d)$/', $param[4]))
            ++$check;
        if (!$check)
        {
            $timeref = strtotime("1970-01-01 00:00:00");
            $timepar = strtotime($param[3].'-'.key($monthi).'-'.$param[1].' '.$param[4]);
            echo $timepar - $timeref . "\n";
        } else {
            echo "Wrong Format\n";
        }
    } else {
        echo "Wrong Format\n";
    }
?>