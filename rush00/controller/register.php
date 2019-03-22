<?php
    require_once("../model/database.php");
    require_once("../model/user.php");
    $co = new Database();
    $co = $co->login();
?>