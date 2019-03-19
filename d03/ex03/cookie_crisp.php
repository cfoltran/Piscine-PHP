<?php
    if ($_GET && isset($_GET['action'])) {
        if ($_GET['action'] == 'set') {
            if (!isset($_GET['name']) || !isset($_GET['value']))
                exit();
            setcookie($_GET['name'], $_GET['value']);
        }
        if ($_GET['action'] == 'get') {
            if (!isset($_GET['name']) || !isset($_COOKIE[$_GET['name']]))
                exit();
            echo $_COOKIE[$_GET['name']] . "\n";
        }
        if ($_GET['action'] == 'del') {
            if (!isset($_GET['name']) || !isset($_COOKIE[$_GET['name']]))
                exit();
            setcookie($_GET['name'], '', -1);
        }
    }
?>