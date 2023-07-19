<?php
// セッションスタート
session_start();

// セッション変数を空にする
$_SESSION = [];

// セッションクッキーが存在する場合には全て削除
if (isset($_COOKIE[session_name()])) {
    $cParam = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 3600,
        $cParam['path'],
        $cParam['domain'],
        $cParam['secure'],
        $cParam['httponly']
    );
}
// セッションを破棄
session_destroy();

// ログアウト後は　index.php　へリダイレクト
header('Location:index.php');
