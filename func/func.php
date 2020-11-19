<?php
session_start();

// initial ADMIN_ID as 1
define('ADMIN_ID', '1');


// check if a user has logged in
function checkUserLogin()
{
    if (!isset($_SESSION['uid'])) {
        return false;
    }
    return true;
}

// get login info
function getLogin()
{
    return [
        'uid' => isset($_SESSION['uid']) ? $_SESSION['uid'] : 0 ,
        'bid' => isset($_SESSION['bid']) ? $_SESSION['bid'] : 0 ,
        'mid' => isset($_SESSION['mid']) ? $_SESSION['mid'] : 0 ,
    ];
}

?>