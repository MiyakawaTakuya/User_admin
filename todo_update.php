<?php
// var_dump($_POST); 
// exit();

if (
    !isset($_POST['todo']) || $_POST['todo'] == '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

//POSTで送られてきたものを変数定義する
//$_GETになってしまってると正しく受け取れないので注意！！
$todo = $_POST['todo'];
$deadline = $_POST['deadline'];
$id = $_POST['id'];

//DB接続
include('functions.php');
$pdo = connect_to_db();
// 各値をpostで受け取る $id = $_POST['id']; ...
// idを指定して更新するSQLを作成(UPDATE文)
$sql = 'UPDATE todo_table SET todo=:todo, deadline=:deadline, updated_at=sysdate() WHERE id=:id';
//いつアップデートされたかも記載する  //WHEREでidを特定する！！特定しないと全部のデータが更新される
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 各値をpostで受け取る
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する 
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する 
    header("Location:todo_read.php");
    exit();
}
