<?php
//include（‘ファイル’）で事前にfunction.phpを結びつける
//DBが複雑になってきたりする時にDB接続を関数化しておくとすごく扱いやすい
//デプロイが楽になる
include('functions.php');
$pdo = connect_to_db();  //接続パラメータを別ファイルで用意し、pdo処理を定義

if (
  !isset($_POST['todo']) || $_POST['todo'] == '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}
//受け取った値の定義
$todo = $_POST['todo'];
$deadline = $_POST['deadline'];


//SQL文をCreate
$sql = 'INSERT INTO todo_table(id, todo, deadline, created_at, updated_at) VALUES(NULL, :todo, :deadline, sysdate(), sysdate())';
///プリペアードステートメントを作る statement
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
//$stmtでSQL文を実行する
$status = $stmt->execute();
//SQL文の実行ではSQL文の構造解析、コンパイル、最適化が行われる
//SQL文をプリペアードエステートメントにしておくと、同じSQL文を繰り替え石実行する場合の最初の１回だけで処理が完了する。
//また、プレースホルダが使えると言う大きな利点がある

//接続に失敗したら、例外処理が実行される
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_input.php");
  exit();
}
