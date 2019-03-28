<?php
    function ft_is_sort($array) {
        $save = $array;
        sort($array);
        if ($save === $array)
            return (1);
        rsort($array);
        if ($array === $save)
            return (1);
        return (0);
    }
?>