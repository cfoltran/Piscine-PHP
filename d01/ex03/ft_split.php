#!/usr/bin/php
<?php
    function    ft_split($s)
    {
        if ($s)
        {
            $result = explode(' ', preg_replace('/ +/', ' ', trim($s)));
            sort($result);
            return ($result);
        }
    }
?>

