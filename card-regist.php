<?php
session_start();
// 関数ファイル読み込み
include('function.php');

// LOGIN認証チェック関数を実行
loginCheck();
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
            <h2 class="mb-2 text-center text-2xl font-bold text-gray-800 md:mb-2 lg:text-3xl">カード登録</h2>

            <form action="card-insert.php" method="POST" enctype="multipart/form-data" class="mx-auto max-w-lg">
                <div class="flex flex-col gap-4 p-4 md:p-8">

                    <div>
                        <label for="today_events" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">登録したいカードを選択</label>
                        <input type="file" name="card_filename" accept="image/*" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                        <input>
                    </div>


                    <input type="submit" value="登録する" class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">

                </div>


            </form>
        </div>
    </div>
    <?php include('include/footer.php'); ?>

</body>


</html>