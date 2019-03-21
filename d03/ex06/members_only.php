<?php
    function error() {
        header('WWW-Authenticate: Basic realm="Espace membre"');
        header('HTTP/1.1 401 Unauthorized');
        echo '<html><body>Cette zone est accessible uniquement aux membres du site</body></html>' . "\n";
        exit();
    }
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))
        error();
    if ($_SERVER['PHP_AUTH'] != 'zaz' && $_SERVER['PHP_AUTH_PW'] != 'jaimelespetitsponeys')
        error();
    else
        echo '<html><body>Bonjour Zaz<br /><img src="data:image/png;base64,' .  base64_encode(file_get_contents("../img/42.png")) . '</body></html>'
?>
<html>
    <body>
    Bonjour Zaz<br/>
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents("../img/42.png")) ?>">
    </body>
</html>