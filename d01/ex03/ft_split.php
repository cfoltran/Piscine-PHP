<?php
    function    ft_split($s)
    {
        if ($s && gettype($s) == "string")
        {
            $result = explode(' ', preg_replace('/ +/', ' ', trim($s)));
            sort($result);
            return ($result);
        }
    }
?>