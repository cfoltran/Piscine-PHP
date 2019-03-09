#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $result = array();
        for ($i = 1; $i < $argc; $i++) {
            $result = array_merge($result, explode(' ', preg_replace('/ +/', ' ', trim($argv[$i]))));
        }
        sort($result);
        foreach ($result as $elem) {
            echo $elem . "\n";
        }
    }
?>