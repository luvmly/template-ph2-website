<?php
require '../dbconnect.php';
$sql = "SELECT * FROM choices";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $qKey => $question) {
    // echo('<pre>');
    // var_dump($question);
    // echo('</pre>');
    $question["choices"] = [];
    foreach ($choices as $cKey => $choice) {
        if ($choice["question_id"] == $question["id"]) {
            $question["choices"][] = $choice;
        }
    }
    $questions[$qKey] = $question;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/admin.css">
</head>
<body>
    <header class="header">
        <div>POSSE</div>
        <div>ログアウト</div>
    </header>
    <main>
        <div class="left">
            <div>ユーザー招待</div>
            <div>問題一覧</div>
            <div>問題作成</div>
        </div class="right">
            <h1>問題一覧</h1>
            <h2 class="h2">ID 問題</h2>
            <?php for ($i = 0; $i < count($questions); $i++) {?>
            <div class="">
                <div><?= $questions[$i]["id"]?></div>
                <a href="./"><?= $questions[$i]["content"]?></a>
                <div>削除</div>
            </div>
            <?php } ?>
        <div>

        </div>
    </main>
    <footer>

    </footer>
</body>
</html>