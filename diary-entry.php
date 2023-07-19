<?php
session_start();
// 関数ファイル読み込み
include('function.php');
// user_nameを取得
$user_name = $_SESSION['user_name'];


//1.GETでidを取得
$diary_id = $_GET["diary_id"];

// DB接続用関数を実行
$pdo = db_connect();

// テーブルセレクトのＳＱＬ作成
$sql = "SELECT * FROM dev13_diary WHERE diary_id=:diary_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':diary_id', $diary_id, PDO::PARAM_INT); // idは数値なのでINT

try {
    $status = $stmt->execute(); // SQL実行
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// データ表示
// $view = "";
if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("（SQLエラー）ErrorQuery:" . $error[2]);
} else {
    // 1データのみ抽出の場合はwhileループで取り出さない
    $row = $stmt->fetch();
    // $row["id"] $row["name"]などでデータをとりだせます
}

// 日記登録日を変数に格納
$registration_date = $row["registration_date"];

// 日記登録日の表記を0000年00月00日に変換
$registration_date_format = date('Y年m月d日', strtotime($registration_date));


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>記録</title>
</head>


<body>
    <?php include('include/header.php'); ?>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-2 text-center text-2xl font-bold text-gray-800 md:mb-2 lg:text-3xl"><?= $registration_date_format ?></h2>
            <div class="mx-auto max-w-lg">
                <h3 class="mb-4 text-center text-lg font-bold text-gray-800 md:mb-8 lg:text-2xl"><?= $user_name ?>さんの出来事</h3>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">今日、あなたの中で印象に残った出来事</h4>
                    <p class="md:mb-8"><?= $row["today_events"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">印象に残ったきっかけは</h4>
                    <p class="md:mb-8"><?= $row["events_impression"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">どんな気持ちや感情が生まれました
                    </h4>
                    <p class="md:mb-8"><?= $row["events_emotions"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">この感情に点数をつけると何点？
                    </h4>
                    <p class="md:mb-8"><?= $row["events_points"] ?>点</p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">点数をつけた理由は？？
                    </h4>
                    <p class="md:mb-8"><?= $row["events_points_reason"] ?></p>
                </div>
                <h3 class="mb-4 text-center text-lg font-bold text-gray-800 md:mb-8 lg:text-2xl">今日の1枚</h3>
                <div>
                    <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg  md:mb-8">
                        <img src="card_images/<?= $row["select_card_filename"] ?>" loading=" lazy" alt="" class="h-full w-full object-cover object-center" />
                    </div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">この写真から、頭の中に浮かぶ言葉は何？</h4>
                    <p class="md:mb-8"><?= $row["photo_keyword"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">その言葉が浮かんだ理由は？</h4>
                    <p class="md:mb-8"><?= $row["photo_keyword_reason"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">この言葉から、どんな感情や気持ちが生まれました？</h4>
                    <p class="md:mb-8"><?= $row["photo_emotions"] ?></p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">この感情に点数をつけると何点？</h4>
                    <p class="md:mb-8"><?= $row["photo_points"] ?>点</p>
                </div>
                <div>
                    <h4 class="mb-2 inline-block text-sm text-gray-800 sm:text-base font-bold">点数をつけた理由は？</h4>
                    <p class="md:mb-8"><?= $row["photo_points_reason"] ?></p>
                </div>




            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>

</body>


</html>