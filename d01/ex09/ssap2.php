#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $array = array();
        for ($i = 1; $i < $argc; $i++)
            $array = array_merge($array, explode(' ', preg_replace('/ +/', ' ', trim($argv[$i]))));
        sort($array);
        $sort = array(array(), array(), array());
        foreach ($array as $elem) {
            if (is_numeric($elem))
                array_push($sort[1], $elem);
            else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $elem))
                array_push($sort[2], $elem);
            else
                array_push($sort[0], $elem);
        }
        for ($i = 0; $i < count($sort); $i++)
            usort($sort[$i], "strcasecmp");
        $array = array_merge($sort[0], $sort[1]);
        $array = array_merge($array, $sort[2]);
        print_r($array);
    }
?>