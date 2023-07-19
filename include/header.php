<?php

// 変数の初期化
$header_login_bt_name = '';
$header_login_bt_url = '';

if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
    $header_login_bt_name = 'ログイン';
    $header_login_bt_url = 'login.php';
} else {
    $header_login_bt_name = 'ログアウト';
    $header_login_bt_url = 'logout.php';
}
?>

<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="index.php" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="asset/svg/logo.svg" alt="">
            </a>
        </div>
        <div class="flex flex-1 items-center justify-end gap-x-6">
            <a href="<?= $header_login_bt_url ?>" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><?= $header_login_bt_name ?></a>
        </div>
    </nav>

</header>