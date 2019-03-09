#!/usr/bin/php
<?php
    $result = explode(' ', preg_replace('/ +/', ' ', trim($argv[1])));
    if (($len = sizeof($result)) > 1)
    {
        $tmp = $result[0];
        $result[0] = $result[$len - 1];
        $result[$len - 1] = $tmp; 
    }
    print_r($result);
    for ($i = 0; $i <= $len; $i++) {
        echo $result[$i];
        if ($i != $len - 1)
            echo ' ';
    }
?>