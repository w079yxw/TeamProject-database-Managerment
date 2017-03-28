<?php
    $dsn = 'mysql:host=localhost;dbname=CEG4981';
    $username = 'root';//'rhodes' <--for server;
    $password = 'password';//'cynics4fitful' <--for server;
    

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');//needs to be implemented
        exit();
    }
?>
