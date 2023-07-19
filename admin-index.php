<?php
session_start();
// 関数ファイル読み込み
include('function.php');

// LOGIN認証チェック関数を実行
loginCheck();

// DB接続用関数を実行
$pdo = db_connect();

// SQL作成&実行
$sql = "SELECT * FROM dev13_diary WHERE 1";
$stmt = $pdo->prepare($sql);



// テーブルセレクトのＳＱＬ作成
$sql = "SELECT * FROM dev13_diary";
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute(); // SQL実行
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// データ表示
$view = "";
if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("（SQLエラー）ErrorQuery:" . $error[2]);
} else {
    // Selectデータの数だけ自動でループしてくれる
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // GETデータ送信リンク作成
        $view .= "
              <div class=\"mx-auto flex max-w-screen-sm flex-col border-t \">
                <div class=\"border-b\">
                        <div class=\"flex cursor-pointer justify-between gap-2 py-4 text-black hover:text-indigo-500 active:text-indigo-600 \">
                            <span class=\"font-semibold transition duration-100 md:text-lg \">{$result["registration_date"]}</span><a href=\"diary-entry.php?diary_id={$result["diary_id"]}\">記事を確認</a><a href=\"diary-edit.php?diary_id={$result["diary_id"]}\">編集</a><a href=\"diary-delete.php?diary_id={$result["diary_id"]}\">削除</a>
                        </div>
                </div>
            </div>
        ";
    }
}
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
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">日記の一覧</h2>
                <div class="mt-10 flex items-center justify-center gap-x-6 mb-10 ">
                    <a href="diary-regist.php" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">新しい日記を作成する</a>
                    <a href="card-regist.php" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">新しいカードを登録する</a>
                </div>


                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">過去の日記の一覧</p>
            </div>
            <!-- text - end -->
            <?= $view ?>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
</body>

</html>