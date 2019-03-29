#!/usr/bin/php

<?php
    foreach ($_GET as $key => $value)
        if ($value != NULL)
            echo $key . ": " . $value . "\n";
?>