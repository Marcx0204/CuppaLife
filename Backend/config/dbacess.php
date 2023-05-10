<?php
    session_start();
    // Database access
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword ='';
    $dbname = 'cuppalife_db';

    $db = new mysqli($dbhost,$dbuser,$dbpassword,$dbname);
    $db->set_charset('utf8');
?>