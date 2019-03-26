#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $result = array();
        array_shift($argv);
        foreach ($argv as $value)
            $result = array_merge($result, explode(' ', preg_replace('/ +/', ' ', trim($value))));
        sort($result);
        foreach ($result as $value)
            echo "$value\n";
    }
?>