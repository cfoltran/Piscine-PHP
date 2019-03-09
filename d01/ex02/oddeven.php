#!/usr/bin/php
<?php
    while (true)
    {
        echo 'Entrez un nombre: ';
        $param = trim(fgets(STDIN));
        if (feof(STDIN) == true)
            exit();
        if (is_numeric($param))
        {
            if (substr($param, -1) % 2 == 0)
                echo "Le chiffre ".$param." est Pair\n";
            else
                echo "Le chiffre ".$param." est Impair\n";
        }
        else
            echo "'".$param."' n'est pas un chiffre\n";
    }
?>
