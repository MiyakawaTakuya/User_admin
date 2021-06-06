<?php

function connect_to_db()
{   //利用するデータベース,データベースユーザ,パスワード
    $dbn = 'mysql:dbname=gsacf_l05_12;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';
    //MySQLデータベースに接続する
    try {
        // $pdo = new PDO($dbn, $user, $pwd);と記載されていたところをreturnで返り値にしている
        return new PDO($dbn, $user, $pwd);  //データベースに接続
    } catch (PDOException $e) {
        //接続に失敗したら、例外処理が実行される
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}
