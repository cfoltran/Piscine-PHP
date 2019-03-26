#!/usr/bin/php
<?php
    echo 'Entrez un nombre: ';
    while ($input = fgets(STDIN))
    {
        $param = trim($input);
        if (is_numeric($param))
        {
            if (substr($param, -1) % 2 == 0)
                echo "Le chiffre ".$param." est Pair\n";
            else
                echo "Le chiffre ".$param." est Impair\n";
        }
        else
            echo "'".$param."' n'est pas un chiffre\n";
        echo 'Entrez un nombre: ';
    }
    echo "\n";
?>
