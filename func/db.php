<?php


try {
    // it is was git ignore
    $user = 'root';
    $pass = 'hkc610787';
    $host = '127.0.0.1:3307';
    $dbname = 'CONSYS';

    global $db; 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);


} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
};