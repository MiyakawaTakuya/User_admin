<?php
//データベース接続
include('functions.php');
$pdo = connect_to_db();
//SQL文発行 *は全てのカラム テーブル名
//プレースホルダーを使ったSQL分にする :minの部分がプレースホルダ
$sql = 'SELECT * FROM todo_table
WHERE dedline >= :min AND <= :max AND sex = :sex';
////キー名はまだ教本のもの、しっかり変更すること！！////
$stmt = $pdo->prepare($sql);
//プレースホルダに値をバインドする
$stm->bindValue(':min', 25, PDO::PARAM_INT);
$stm->bindValue(':max', 40, PDO::PARAM_INT);
$stm->bindValue(':sex', '男', PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  //SQL文の実行結果を取得するためfetchALL関数を改めて実行  PDO::FETCH_ASSOCで全ての行の値を連想配列で取得する
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  //連想配列のかたちをしている
  // データの出力用の変数（初期値は空文字）を設定
  $output = "";
  foreach ($result as $record) {  //取得した$resultを行として入れていく
    $output .= "<tr>";
    $output .= "<td>{$record["deadline"]}</td>"; //record配列の中のキーdeadlineの値を
    $output .= "<td>{$record["todo"]}</td>";
    // edit deleteリンクを追加
    $output .= "<td>
<a href='todo_edit.php?id={$record["id"]}'>edit</a>
</td>";
    $output .= "<td>
<a href='todo_delete.php?id={$record["id"]}'>delete</a>
</td>";
    $output .= "</tr>";
  }
  // $recordの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
  <link href="./CSS/main.css" rel="stylesheet">
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>