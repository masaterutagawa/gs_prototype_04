<?php
session_start();
// 関数ファイル読み込み
include('function.php');

// LOGIN認証チェック関数を実行
loginCheck();

// DB接続用関数を実行
$pdo = db_connect();

// SQL作成&実行
$sql = "SELECT card_filename FROM dev13_card";
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = [];
foreach ($result as $record)
    $output[] = $record["card_filename"];

// 配列の中からランダムに1つ選ぶ
$randomCardName = $output[array_rand($output)];
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
            <h2 class="mb-2 text-center text-2xl font-bold text-gray-800 md:mb-2 lg:text-3xl">今日の出来事</h2>

            <form action="insert.php" method="POST" class="mx-auto max-w-lg">
                <div class="flex flex-col gap-4 p-4 md:p-8">

                    <div>
                        <label for="today_events" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">今日、あなたの中で印象に残った出来事</label>
                        <input name="today_events" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="events_impression" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">印象に残ったきっかけは</label>
                        <input name="events_impression" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="events_emotions" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">どんな気持ちや感情が生まれました</label>
                        <input name="events_emotions" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="events_points" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">この感情に点数をつけると何点？</label>
                        <input name="events_points" type="number" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="events_points_reason" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">点数をつけた理由は？</label>
                        <textarea name="events_points_reason" id="" cols="30" rows="10" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"></textarea>

                    </div>

                    <h3 class="mb-4 text-center text-lg font-bold text-gray-800 md:mb-8 lg:text-2xl">今日の1枚</h3>
                    <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                        <img src="card_images/<?= $randomCardName ?>" loading="lazy" alt="Photo by Martin Sanchez" class="h-full w-full object-cover object-center" />
                        <input name="select_card_filename" type="hidden" value="<?= $randomCardName ?>" />
                    </div>
                    <div>
                        <label for="photo_keyword" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">この写真から、頭の中に浮かぶ言葉は何？</label>
                        <input name="photo_keyword" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="photo_keyword_reason" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">その言葉が浮かんだ理由は？</label>
                        <input name="photo_keyword_reason" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="photo_emotions" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">この言葉から、どんな感情や気持ちが生まれました？</label>
                        <input name="photo_emotions" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="photo_points" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">この感情に点数をつけると何点？</label>
                        <input name="photo_points" type="number" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    <div>
                        <label for="photo_points_reason" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">点数をつけた理由は？</label>
                        <textarea name="photo_points_reason" id="" cols="30" rows="10" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"></textarea>
                    </div>

                    <input type="submit" value="記録する" class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">

                </div>


            </form>
        </div>
    </div>
    <?php include('include/footer.php'); ?>

</body>


</html>