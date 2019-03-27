#!/usr/bin/php
<?php
    function compare($s1, $s2) {
        for ($i = 0; ($i < strlen($s1) && $i < strlen($s2)); $i++) {
            if ($s1[$i] == $s2[$i])
                continue ;
            if (ctype_alpha($s1[$i])) {
                if (ctype_alpha($s2[$i])) {
                    if (strcmp(strtolower($s1[$i]), strtolower($s2[$i])) == 0)
                        continue ;
                    return (strcmp(strtolower($s1[$i]), strtolower($s2[$i])));
                }
                return (-1);
            } else if (is_numeric($s1[$i])) {
                if (ctype_alpha($s2[$i]))
                    return (1);
                else if (is_numeric($s2[$i]))
                    return (strcmp($s1[$i], $s2[$i]));
                return (-1);
            } else {
                if (!ctype_alpha($s2[$i]) && !is_numeric($s2[$i]))
                    return (strcmp($s1[$i], $s2[$i]));
                return (1);
            }
        }
        return (strlen($s1) - strlen($s2));
    }
    
    if ($argc  > 1) {
        $array = [];
        array_shift($argv);
        foreach ($argv as $arg)
            $array = array_merge($array, array_filter(explode(" ", trim($arg)), "strlen"));
        usort($array, 'compare');
        foreach ($array as $value)
            echo "$value\n";
    }
?>