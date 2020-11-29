<?php


try {
    // it is was git ignore
    $user = 'root';
    $pass = 'Alex112524';
    $host = '127.0.0.1:3306';
    $dbname = 'CON_system';

    global $db; 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);


} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
};
?>