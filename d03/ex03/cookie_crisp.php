<?php
    function ft_isset($tocheck) {
        return (($tocheck !== NULL) ? 1 : 0);
    }

    if ($_GET && ft_isset($_GET['action'])) {
        if ($_GET['action'] == 'set') {
            if (!ft_isset($_GET['name']) || !ft_isset($_GET['value']))
                exit();
            setcookie($_GET['name'], $_GET['value']);
        }
        if ($_GET['action'] == 'get') {
            if (!ft_isset($_GET['name']) || !ft_isset($_COOKIE[$_GET['name']]))
                exit();
            echo $_COOKIE[$_GET['name']] . "\n";
        }
        if ($_GET['action'] == 'del') {
            if (!ft_isset($_GET['name']) || !ft_isset($_COOKIE[$_GET['name']]))
                exit();
            setcookie($_GET['name'], '', -1);
        }
    }
?>