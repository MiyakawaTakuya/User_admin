<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User management</title>
    <link href="./CSS/main.css" rel="stylesheet">
</head>

<body>
  <form action="todo_create.php" method="POST">
    <fieldset>
      <legend>User management</legend>
      <a href="todo_read.php">一覧画面へ</a>
      <div>
        Name <input type="text" name="name">
      </div>
      <div>
        主な勤務地<input type="text" name="work_place">
      </div>
      <div>
        Age<input type="number" name="age">
      </div>
      <div>
        BirthDay<input type="date" name="age">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>