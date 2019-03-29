<?php
    if ($_POST['login'] !== "" && $_POST['newpw'] !== "" && $_POST['oldpw'] !== "" && $_POST['submit'] === 'OK') {
        // Get users from ../private/passwd
        $users = @file_get_contents('../private/passwd');
        if (!$users)
            exit("ERROR\n");
        else
            $users = unserialize($users);
        // Check if the user already exist
        $exist = 0;
        foreach ($users as $key => $value)
            if (($value['login'] === $_POST['login']) && (hash('whirlpool', $_POST['oldpw']) === $value['passwd'])) {
                $users[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
                $exist = 1;
            }
        if (!$exist) {
            echo "ERROR\n";
            return ;
        }
        // Put the user in ../private/posswd
        file_put_contents('../private/passwd', serialize($users));
        echo "OK\n";
    }
    else 
        echo "ERROR\n";
?>