<?php
    function    auth($login, $passwd) {
        if ($passwd === "" || $login === "")
            return (false);
        $users = unserialize(file_get_contents('../private/passwd'));
        if ($users)
            foreach ($users as $key => $value)
                if (($value['login'] === $login) && ($value['passwd'] === hash('whirlpool', $passwd)))
                    return (true);
        return (false);
    }
?>