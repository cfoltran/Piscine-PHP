<?php
    if ($_GET !== NULL)
        foreach ($_GET as $key => $value)
            echo $key . ": " . $value . "\n";
?>