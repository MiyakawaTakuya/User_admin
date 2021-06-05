<?php
// var_dump($_GET);
// exit();

// 送信されたidをgetで受け取る
$id = $_GET['id'];

include('functions.php');
$pdo = connect_to_db();

// DB接続&id名でテーブルから検索
$pdo = connect_to_db();
$sql = 'SELECT * FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// fetch()で1レコード取得できる. 
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        todo: <input type="text" name="todo" value="<?= $record['todo'] ?>">
      </div>
      <div>
        deadline: <input type="date" name="deadline" value="<?= $record['deadline'] ?>">
      </div>
      <!-- // idを見えないように送る -->
      <!-- // input type="hidden"を使用する! -->
      <!-- // form内に以下を追加 表側には出ないがフォームタグの中にしっかりといれる-->
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      <!-- // 更新のformは，登録と同じくpostで各値を送信しています! -->
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>