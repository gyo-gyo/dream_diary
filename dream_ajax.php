<?php


// DB接続の設定
// DB名は`gsacf_x00_00`にする
if (

    !isset($_POST['day']) || $_POST['day'] == ''
) {
    exit('ParamError');
}
$dbn = 'mysql:dbname=gsf_d06_db12;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    // ここでDB接続処理を実行する
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// データ取得SQL作成
$sql = 'SELECT * FROM dream_table WHERE id = ($day)';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();



// SQL準備&実行


$view = '';
// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    // 常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる

    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<table border='5' width='70%' align='center' >";
        $output .= " <tr>";
        $output .= "<td>{$record["date"]}</td>";
        $output .= "<td>{$record["time"]}時から{$record["times"]}時間寝たよ</td>";
        $output .= "</tr>";
        $output .= "<tr>";
        $output .= "<td>{$record["type"]}</td>";
        $output .= "<td>{$record["comment"]}</td>";
        $output .= "</tr>";
        $output .= "</table>";
    }
}
// 正


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>夢リスト（一覧画面）</title>
</head>

<body>
    <fieldset>
        <legend>夢リスト（一覧画面）</legend>
        <a href="dream_daiary.php">入力画面</a>
        <table border='5' width='70%' align='center'>
            <thead>
                <tr>
                    <th>deadline</th>
                    <th>time</th>
                    <th>times</th>
                </tr>
                <tr>
                    <th>type</th>
                    <th>comment</th>
                </tr>
            </thead>
        </table>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>


    </fieldset>
</body>

</html>