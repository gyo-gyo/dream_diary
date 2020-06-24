<?php

// // 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_POST['times']) || $_POST['times'] == '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
    !isset($_POST['type']) || $_POST['type'] == '' ||
    !isset($_POST['time']) || $_POST['time'] == '' ||
    !isset($_POST['comment']) || $_POST['comment'] == ''
) {
    exit('ParamError');
}
// 解説  // 「ParamError」が表示されたら，必須データが送られていないことがわかる


// 受け取ったデータを変数に入れる
$times = $_POST['times'];
$deadline = $_POST['deadline'];
$type = $_POST['type'];
$time = $_POST['time'];
$comment = $_POST['comment'];

if (isset($_POST['time'])) {
    //$_POST['gender']がすでに定義されている（値が送信されている）場合
    echo htmlspecialchars($_POST['time'], ENT_QUOTES, 'UTF-8');
}


// DB接続の設定
// DB名は`gsacf_x00_00`にする
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
// var_dump($_POST);
// exit();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = ' INSERT INTO dream_table(id,type, time, date, times, comment)              
  VALUES(NULL,:type, :time, :date, :times, :comment)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':date', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':time', $time, PDO::PARAM_STR);
$stmt->bindValue(':times', $time, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$status = $stmt->execute();



// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header('Location:dream_daiary.html');
}
