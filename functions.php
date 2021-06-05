<?php

function connect_to_db()
{
    $dbn = 'mysql:dbname=gsacf_l05_12;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        // $pdo = new PDO($dbn, $user, $pwd);
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}
