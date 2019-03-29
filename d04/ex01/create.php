<?php
    if ($_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['submit'] === 'OK') {    
        // Get users from ../private/passwd
        $users = @file_get_contents('../private/passwd');
        if (!$users) {
            $users = [];
            @mkdir('../private');
        } else {
            $users = unserialize($users);
        }
        // Check if the user exist
        foreach ($users as $key => $value)
            if ($value['login'] === $_POST['login']) {
                echo "ERROR\n";
                return ;
            }  
        // If no users or users does not exists
        $users[] = [
            "login" => $_POST['login'],
            "passwd" => hash('whirlpool', $_POST['passwd'])
        ];
        // Put the user in ../private/posswd
        file_put_contents('../private/passwd', serialize($users));
        echo "OK\n";
    } else
        print("ERROR\n");
?>