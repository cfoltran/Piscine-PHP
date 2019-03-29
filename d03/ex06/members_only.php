<?php
    function ft_isset($tocheck) {
        return (($tocheck !== NULL) ? 1 : 0);
    }

    function error() {
        header('WWW-Authenticate: Basic realm="Espace membre"');
        header('HTTP/1.1 401 Unauthorized');
        echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
        exit();
    }
    if (!ft_isset($_SERVER['PHP_AUTH_USER']) || !ft_isset($_SERVER['PHP_AUTH_PW']))
        error();
    if ($_SERVER['PHP_AUTH'] != 'zaz' && $_SERVER['PHP_AUTH_PW'] != 'jaimelespetitsponeys')
        error();
    else
        echo "<html><body>\n";
        echo "Bonjour Zaz<br />\n";
        print("<img src=\"data:image/png;base64," . base64_encode(file_get_contents("../img/42.png")) . "\">\n</body></html>\n");
?>
