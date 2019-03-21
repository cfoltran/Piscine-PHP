<?php
    // Check POST entry
    if (!$_POST || !isset($_POST['submit']) || $_POST['submit'] !== 'OK')
        exit("ERROR\n");
    if (!isset($_POST['login']) || !isset($_POST['passwd']) || empty($_POST['login']) || empty($_POST['passwd']))
        exit("ERROR\n");
    
    // Get users from ../private/passwd
    $users = @file_get_contents('../private/passwd');
    if (!$users) {
        $users = [];
        @mkdir('../private');
    } else {
        $users = unserialize($users);
    }

    // Check if the user exist
    $exist = 0;
    foreach ($users as $key => $value)
        $exist = ($value['login'] === $_POST['login']) ? exit("ERROR\n") : 0;
        
    // If no users or users does not exists
    $users[] = [
        "login" => $_POST['login'],
        "passwd" => hash('whirlpool', $_POST['passwd'])
    ];

    // Put the user in ../private/posswd
    file_put_contents('../private/passwd', serialize($users));

    echo "OK\n";
?>