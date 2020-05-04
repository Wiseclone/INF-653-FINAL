<?php
    $dsn = 'mysql:host=c584md9egjnm02sk.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=iqxg3rlmn4xsq2lm';
    $username = 'slkrtqn25n0p23mv';
    $password = 'xhgc9v16o0dym58x';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
