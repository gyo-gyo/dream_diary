<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>夢日記</title>
</head>

<body>
    <form action="dream_ajax.php" method="POST">
        <fieldset>
            <legend>夢（入力画面）</legend>
            <a href="dream_read.php">夢一覧</a>
            <a href="dream_daiary.php">夢日記</a>
            <div>
                日付「起きた日」: <input type="date" name="deadline">
            </div>
            <div>
                寝た時間:
                <select name="time" size="1">
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div>
                睡眠時間: <input type="text" name="times">
            </div>
            <div>
                見た夢のジャンル:
                <input type="radio" name="type" value="恋愛"> 恋愛
                <input type="radio" name="type" value="死ぬ夢"> 死ぬ夢
                <input type="radio" name="type" value="追いかけられるゆめ"> 追いかけられるゆめ
                <input type="radio" name="type" value="楽しい夢"> 楽しい夢
                <input type="radio" name="type" value="気持ち悪い夢"> 気持ち悪い夢
                <input type="radio" name="type" value="その他"> その他<br>

            </div>
            <div>
                詳細
                <input type="text" name="comment">

            </div>

            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>

</body>

</html>