<?php

$id = $_GET['id'];

//DB接続
include('functions.php');
$pdo = connect_to_db();

// idを指定して更新するSQLを作成 -> 実行の処理
$sql = 'DELETE FROM todo_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// fetch()で1レコード取得できる. 
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 一覧画面にリダイレクト 
    header('Location:todo_read.php');
    exit();
}
