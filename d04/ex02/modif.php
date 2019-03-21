<?php
    // Check POST entry
    if (!$_POST || !isset($_POST['submit']) || $_POST['submit'] !== 'OK')
        exit("ERROR\n");
    if (!isset($_POST['login']) || !isset($_POST['newpw']) || empty($_POST['login']) || empty($_POST['newpw'])
        || empty($_POST['oldpw']) || !isset($_POST['oldpw']))
        exit("ERROR\n");
    
    // Get users from ../private/passwd
    $users = @file_get_contents('../private/passwd');
    if (!$users)
       exit("ERREUR\n");
    else
        $users = unserialize($users);

    // Check if the user already exist
    $exist = 0;
    foreach ($users as $key => $value)
        if (($value['login'] === $_POST['login']) && (hash('whirlpool', $_POST['oldpw']) === $value['passwd'])) {
            $users[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
            $exist = 1;
        }
    if (!$exist)
        exit("ERROR\n");
    
    // Put the user in ../private/posswd
    file_put_contents('../private/passwd', serialize($users));
    echo "OK\n";
?>