<?php


try {

    // $user = 'lac353_2';
    // $pass = 'Q39qNn';
    // $host = 'lac353.encs.concordia.ca';
    // $dbname = 'lac353_2';

    $user = 'root';
    $pass = 'Alex112524';
    $host = '127.0.0.1:3306';
    $dbname = 'lac353_2';

    global $db;
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);


} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
};