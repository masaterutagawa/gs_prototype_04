<?php
session_start();
// 関数ファイル読み込み
include('function.php');

// LOGIN認証チェック関数を実行
loginCheck();

// DB接続用関数を実行
$pdo = db_connect();

// SQL作成&実行
$sql = "SELECT * FROM dev13_user ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = '';
foreach ($result as $record) {
    if ($record["user_flg"] == 0) {
        $user_role = '管理者';
    } else {
        $user_role = '編集者';
    }
    $output .= "
    <tr>
    <td class=\"whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0\">{$record["user_id"]}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$record["user_code"]}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$record["user_name"]}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$record["user_mail"]}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$user_role}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$record["created_at"]}</td>
    <td class=\"whitespace-nowrap px-3 py-4 text-sm text-gray-500\">{$record["updated_at"]}</td>
    <td class=\"relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0\">
    <a href= \"#\" class=\"text-indigo-600 hover:text-indigo-900\">Edit<span class=\"sr-only\"> Lindsay Walton</span></a>
    </td>
    </tr>
";
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


    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">登録ユーザー一覧</h1>
                <p class="mt-2 text-sm text-gray-700">登録ユーザーの一覧だよ</p>
            </div>

        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">ID</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">ユーザーコード</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">ユーザー名</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">メールアドレス</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">権限</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">ユーザー登録日</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">登録情報更新日</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">編集</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?= $output  ?>
                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
</body>

</html>